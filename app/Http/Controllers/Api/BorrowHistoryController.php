<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JsonResponse;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowHistoryController extends Controller
{
    use JsonResponse;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = [];
        $borrows = Borrow::with('book')->whereNotNull('returned_at')->where('user_id', auth()->id())->orderByDesc('id')->get();

        foreach ($borrows as $i => $item) {
            $data[$i]['title'] = $item->book->title;
            $data[$i]['isbn'] = $item->book->isbn;
            $data[$i]['author'] = $item->book->author;
            $data[$i]['publisher'] = $item->book->publisher;
            $data[$i]['year_published'] = $item->book->year_published;
            $data[$i]['borrowed_at'] = $item->created_at->format('d F Y, H:i');
            $data[$i]['borrowed_operator'] = $item->created_by;
            $data[$i]['returned_at'] = $item->returned_at->format('d F Y, H:i');
            $data[$i]['returned_operator'] = $item->returned_by;
        }

        return $this->Ok($data);
    }
}
