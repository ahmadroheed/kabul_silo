<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function addUserPage()
    {
        return view('backend.users.add_users'); // Assuming your view is in the 'backend.users' folder
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $hashedPassword = bcrypt($request->input('password'));
        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $hashedPassword;
        $user->save();
        return response()->json(['message' => 'User created successfully']);
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('email'),
        ]);
        return response()->json(['message' => 'User updated successfully']);
    }
    public function viewUsers()
    {
        $users = User::all();
        return view('backend.users.view_users', ['users' => $users]);
    }
    public function editUser($id)
    {
        try {
            $user = User::find($id);
            return response()->json($user);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            \Log::error($e);
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
