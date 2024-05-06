<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use JsonResponse;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->Error($validator->errors()->first());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->Error('The provided credentials are incorrect.');
        }

        return $this->Ok([
            'token' => $user->createToken($request->email . $request->title)->plainTextToken
        ]);
    }
}
