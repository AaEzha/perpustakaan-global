<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BorrowStoreRequest;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Borrow List';
        $borrows = Borrow::with('user', 'book')->whereNull('returned_by')->latest()->get();

        return view('borrows.index', compact('title', 'borrows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'New Borrow';
        $users = User::select('id', 'name', 'email')->orderBy('name')->get();

        return view('borrows.create', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BorrowStoreRequest $request)
    {
        try {
            $user = User::findOrFail($request->validated('user_id'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        return to_route('borrow-books.show', ['borrow_book' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        try {
            $borrow->book()->decrement('total_borrow');
            $borrow->update([
                'returned_by' => auth()->user()->name,
                'returned_at' => now()
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        return to_route('borrows.index')->with('success', 'Book "' . $borrow->book->title . '" returned');
    }
}
