<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;

class DebtController extends Controller
{
    public function index()
    {
        $this->authorize('manageBorrowing', Book::class);

        $usersWithDebt = User::where('debit', '>', 0)->orderByDesc('debit')->get();

        return view('debts.index', compact('usersWithDebt'));
    }

    public function clear(User $user)
    {
        $this->authorize('manageBorrowing', Book::class);

        $user->update(['debit' => 0]);

        return redirect()->route('debts.index')->with('success', "Débito de {$user->name} zerado com sucesso.");
    }
}