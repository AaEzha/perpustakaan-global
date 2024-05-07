<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $title = 'Dashboard';
        $members = User::select('id')->where('title', User::TITLE_ANGGOTA)->count();
        $books = Book::select('id')->count();

        $books_borrow = Borrow::whereNull('returned_by')->count();
        $members_borrow = Borrow::distinct('user_id')->whereNull('returned_by')->count();

        $borrows_on = Borrow::distinct('user_id')->whereNull('returned_by')->count();
        $borrows_off = Borrow::distinct('user_id')->whereNotNull('returned_by')->count();
        return view('welcome', compact('title', 'members', 'books', 'books_borrow', 'members_borrow', 'borrows_on', 'borrows_off'));
    }
}
