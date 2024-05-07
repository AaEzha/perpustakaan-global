<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BorrowBookUpdateRequest;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class BorrowBookController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $borrow_book)
    {
        $title = 'New Borrow for ' . $borrow_book->name;
        $books = Book::orderBy('title')->get();
        $borrows = Borrow::whereNull('returned_by')->where('user_id', $borrow_book->id)->with('book')->get();

        return view('borrow-books.create', compact('title', 'borrow_book', 'books', 'borrows'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BorrowBookUpdateRequest $request, User $borrow_book)
    {
        try {
            if ($request->has('isbn')) {
                $book = Book::where('isbn', $request->validated('isbn'))->firstOrFail();
            } else {
                $book = Book::find($request->validated('book_id'));
            }

            if ($book->stock() == 0) throw new Exception('Stok buku tidak tersedia');
            $book->increment('total_borrow');
            Borrow::create([
                'user_id' => $borrow_book->id,
                'book_id' => $book->id,
                'created_by' => auth()->user()->name,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        return back()->with('success', 'Book added to list');
    }
}
