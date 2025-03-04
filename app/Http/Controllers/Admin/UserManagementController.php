<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function toggleActivation(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->userId);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Estado del usuario actualizado.');
    }
}
