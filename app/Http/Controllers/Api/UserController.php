<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    // GET /api/users?page=1
    public function index(Request $request) 
    {
        $users = User::paginate(9); // 9 users per page
        return response()->json($users);
    }

    // PATCH /api/users/{user}/activate
    public function activate(User $user)
    {
        $user->status = 'active';
        $user->save();

        return response()->json($user);
    }

    // PATCH /api/users/{user}/deactivate
    public function deactivate(User $user)
    {
        $user->status = 'inactive';
        $user->save();

        return response()->json($user);
    }
}
