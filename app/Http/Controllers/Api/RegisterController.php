<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use JsonResponse;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users|max:200',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return $this->Error($validator->errors()->first());
        }

        $user = User::create($validator->validated());

        return $this->Ok($user);
    }
}
