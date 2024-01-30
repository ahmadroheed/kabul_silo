<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function addUserPage()
    {
        return view('backend.users.add_users'); // Assuming your view is in the 'backend.users' folder
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
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
        try {
            $affectedRows = DB::table('users')
                ->where('id', $id)
                ->update([
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => $request->input('email'), // Note: Are you sure you want to set the password to the email address?
                ]);
        
            if ($affectedRows > 0) {
                return response()->json(['message' => 'User updated successfully']);
            } else {
                return response()->json(['error' => 'User not found or no changes made'], 404);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            \Log::error($e);
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function viewUsers()
    {
        $users = User::all();
        return view('backend.users.view_users', ['users' => $users]);
    }
    public function editUser($id)
    {
        try {
            $user = DB::table('users')->where('id', $id)->first();
        
            if ($user) {
                return response()->json($user);
            } else {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            \Log::error($e);
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function deleteUser($id)
    {
        try {
    $deletedRows = DB::table('users')->where('id', $id)->delete();

    if ($deletedRows > 0) {
        return response()->json(['message' => 'User deleted successfully']);
    } else {
        return response()->json(['error' => 'User not found'], 404);
    }
} catch (\Exception $e) {
    $errorMessage = $e->getMessage();
    \Log::error($e);
    return response()->json(['error' => $errorMessage], 500);
}
    }
}
