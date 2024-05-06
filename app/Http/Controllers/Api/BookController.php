<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JsonResponse;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use JsonResponse;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $books = Book::select(['isbn', 'title', 'author', 'publisher', 'year_published', 'cover'])->get();

        return $this->Ok($books);
    }
}
