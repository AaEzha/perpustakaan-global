<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowHistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $title = 'Borrow History';
        $borrows = Borrow::with('user', 'book')->whereNotNull('returned_by')->latest()->get();

        return view('borrow-history.index', compact('title', 'borrows'));
    }
}
