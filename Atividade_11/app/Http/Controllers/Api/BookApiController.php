<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'publisher', 'category'])->get();

        return response()->json($books, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'pages'         => 'required|integer',
            'publisher_id'  => 'required|exists:publishers,id',
            'author_id'     => 'required|exists:authors,id',
            'category_id'   => 'required|exists:categories,id',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'category']);

        return response()->json($book, 200);
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'         => 'sometimes|required|string|max:255',
            'pages'         => 'sometimes|required|integer',
            'publisher_id'  => 'sometimes|required|exists:publishers,id',
            'author_id'     => 'sometimes|required|exists:authors,id',
            'category_id'   => 'sometimes|required|exists:categories,id',
        ]);

        $book->update($validated);

        return response()->json($book, 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}