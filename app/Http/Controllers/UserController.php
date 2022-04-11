<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\Users\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate();
        $roles = Role::all();

        return view('users.index', compact('users','roles'));
    }

    public function edit(User $user)
    {
        ray($user);
        return response()->json($user->makeHidden(['email_verified_at','created_at', 'updated_at']));
    }

    public function update(User $user, UpdateUserRequest $request) 
    {
        $updated = $user->update($request->validated());
        if ($updated === true) { 
            return response()->json([
                "user" => $user->makeHidden(['email_verified_at','created_at', 'updated_at']),
                "status" => "success",
            ]);
        }
        
    }
}
