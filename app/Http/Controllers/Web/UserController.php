<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserStoreRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Users';
        $users = User::select('id', 'name', 'title', 'email')->get();

        return view('users.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'New User';
        $roles = [
            User::TITLE_ADMIN,
            User::TITLE_ANGGOTA,
        ];

        return view('users.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $password = str()->random(8);
            $data = array_merge($request->validated(), compact('password'));
            $user = User::create($data);
            $user->notify(new NewUserNotification($user->name, $password));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

        return to_route('users.index')->with('success', 'New user added');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit User : ' . $user->name;
        $roles = [
            User::TITLE_ADMIN,
            User::TITLE_ANGGOTA,
        ];

        return view('users.edit', compact('title', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $user->update($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

        return to_route('users.index')->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
