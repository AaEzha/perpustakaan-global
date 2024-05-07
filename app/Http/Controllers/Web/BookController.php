<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BookStoreRequest;
use App\Http\Requests\Web\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Books';
        $books = Book::select('id', 'isbn', 'author', 'title', 'year_published', 'cover', 'total_owned', 'total_borrow')->get();

        return view('books.index', compact('title', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'New Book';

        return view('books.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $cover = $request->file('cover')->store('book-cover');
            $created_by = auth()->user()->name;
            $updated_by = auth()->user()->name;
            $data = array_merge($request->validated(), compact('cover', 'created_by', 'updated_by'));
            Book::create($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

        return to_route('books.index')->with('success', 'New book added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $title = 'Edit Book : ' . $book->title;

        return view('books.edit', compact('title', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        try {
            DB::beginTransaction();
            $old_image = $book->getRawOriginal('cover');
            $validated = $request->validated();
            $updated_by = auth()->user()->name;
            $data = array_merge($request->validated(), compact('updated_by'));
            $book->update($data);
            if ($request->hasFile('cover')) {
                $cover = $request->file('cover')->store('book-cover');
                $book->cover = $request->file('cover')->store('book-cover');
                $book->save();
                if (!is_null($old_image) && Storage::exists($old_image)) Storage::delete($old_image);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
        return to_route('books.index')->with('success', 'Book updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            DB::beginTransaction();
            $book->update(['deleted_by' => auth()->user()->name]);
            $book->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

        return to_route('books.index')->with('success', 'Book deleted');
    }
}
