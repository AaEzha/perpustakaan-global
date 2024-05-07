<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserPasswordRequest;
use App\Models\User;
use App\Notifications\NewUserPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user_password)
    {
        $title = 'Reset Password : ' . $user_password->name;

        return view('users.password', compact('title', 'user_password'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPasswordRequest $request, User $user_password)
    {
        try {
            DB::beginTransaction();
            $user_password->update($request->validated());
            $user_password->notify(new NewUserPasswordNotification($user_password->name, $request->validated('password')));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

        return to_route('users.index')->with('success', 'User password reset');
    }
}
