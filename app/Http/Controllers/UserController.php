<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        $users = User::all();
        $editUser = $request->has('edit') ? User::find($request->edit) : null;
        return view('admin.users', compact('users', 'editUser'));
    }

    public function saveUser(Request $request)
    {
        $data = [
            'name' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('admin.users');
    }

    public function deleteUser(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return redirect()->route('admin.users');
    }
}
