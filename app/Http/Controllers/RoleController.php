<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\AddNewRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct() { 
       $this->middleware('auth');
    }

    public function index() {
        $roles = Role::all();

        if ($roles->count() > 0) { 
            $roles = Role::withCount('users')->get();
        }

        ray($roles);
        

        return view('roles.index')->with([
            'roles' => $roles
        ]);
    }

    public function store(AddNewRole $request)
    {
        ray($request->validated());
        Role::create($request->validated());
        return response()->json([
            "status" => "success"
        ]);
    }
}
