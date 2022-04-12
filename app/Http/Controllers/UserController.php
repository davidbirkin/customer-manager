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
}
