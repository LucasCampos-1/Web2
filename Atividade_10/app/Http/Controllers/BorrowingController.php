<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    private const BORROWING_LIMIT = 5;
    private const LIMIT_DAYS = 15;
    private const FINE_PER_DAY = 0.50;

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $this->authorize('manageBorrowing', Book::class);

        $user = User::findOrFail($request->user_id);

        $userOpenBorrowingsCount = Borrowing::where('user_id', $request->user_id)
            ->whereNull('returned_at')
            ->count();

        if ($userOpenBorrowingsCount >= self::BORROWING_LIMIT) {
            return redirect()
                ->route('books.show', $book)
                ->with('error', 'Este usuário já atingiu o limite de ' . self::BORROWING_LIMIT . ' livros emprestados simultaneamente.');
        }

        if ($user->hasDebt()) {
            return redirect()
                ->route('books.show', $book)
                ->with('error', 'Este usuário possui débito pendente de R$ ' . number_format($user->debit, 2, ',', '.') . ' e não pode realizar novos empréstimos.');
        }

        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Empréstimo registrado com sucesso.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        $this->authorize('manageBorrowing', Book::class);

        $borrowedAt = Carbon::parse($borrowing->borrowed_at);
        $returnedAt = now();

        $dueDate = $borrowedAt->copy()->addDays(self::LIMIT_DAYS);
        $daysLate = $dueDate->diffInDays($returnedAt, false);

        $fineMessage = null;

        if ($daysLate > 0) {
            $fine = round($daysLate * self::FINE_PER_DAY, 2);

            $user = $borrowing->user;
            $user->increment('debit', $fine);

            $fineMessage = "Devolução com {$daysLate} dia(s) de atraso. Multa de R$ " . number_format($fine, 2, ',', '.') . ' adicionada ao débito do usuário.';
        }

        $borrowing->update([
            'returned_at' => $returnedAt,
        ]);

        $message = 'Devolução registrada com sucesso.' . ($fineMessage ? ' ' . $fineMessage : '');

        return redirect()->route('books.show', $borrowing->book_id)->with('success', $message);
    }

    public function userBorrowings(User $user)
    {
        $borrowings = $user->books()->withPivot('borrowed_at', 'returned_at')->get();

        return view('users.borrowings', compact('user', 'borrowings'));
    }
}