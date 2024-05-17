<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getAllUsers(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if a user is authenticated
        if ($user) {
            // User is authenticated, return user data
            $allUsers = User::with('role', 'subscriptions')->get();

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'allUsers' => $allUsers,
            ]);
        } else {
            // User is not authenticated
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated.',
            ], 401); // Unauthorized status code
        }
    }
    public function editUser(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404); // Not found status code
        }

        // Optionally, you can return the user data for editing
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404); // Not found status code
        }

        // Update the user's information based on the request data
        $user->update($request->all());

        // Optionally, you can return the updated user data
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully.',
            'user' => $user,
        ]);
    }

    public function deleteUser(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404); // Not found status code
        }

        // Soft delete the user
        DB::transaction(function () use ($user) {
            $user->delete();
        });

        // Optionally, you can return a success message
        return response()->json([
            'status' => 'success',
            'message' => 'User soft deleted successfully.',
        ]);
    }
}
