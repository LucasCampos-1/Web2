<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books/create-id-number', [BookController::class, 'createWithId'])->name('books.create.id');
Route::get('/books/create-select', [BookController::class, 'createWithSelect'])->name('books.create.select');
Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');

Route::post('/books/create-id-number', [BookController::class, 'storeWithId'])->name('books.store.id');
Route::post('/books/create-select', [BookController::class, 'storeWithSelect'])->name('books.store.select');
Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');

Route::resource('categories', CategoryController::class);
Route::resource('authors', AuthorController::class);
Route::resource('publishers', PublisherController::class);
Route::resource('books', BookController::class)->except(['create', 'store']);
Route::resource('users', UserController::class)->except(['create', 'store', 'destroy']);


Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');