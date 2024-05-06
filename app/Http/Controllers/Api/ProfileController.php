<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use JsonResponse;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->Ok($request->user());
    }
}
