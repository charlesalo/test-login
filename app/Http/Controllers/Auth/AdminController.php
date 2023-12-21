<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
        /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin-dashboard');
    }

    /**
     * Display a list of all users.
     */
    public function index()
    {
        // Get all users from the database
        $users = User::all();

        // Return a view to display the list of users
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing a user's information.
     */
    public function edit(User $user)
    {
        // Return a view to edit a user's information
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update a user's information in the database.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Add other validation rules as needed for user updates
        ]);

        // Update the user's information in the database
        $user->update($request->all());

        // Redirect back to the list of users with a success message
        return redirect()->route('admin.users.index')->with('success', 'User information updated successfully.');
    }

    /**
     * Remove a user from the site.
     */
    public function destroy(User $user)
    {
        // Delete the user from the database
        $user->delete();

        // Redirect back to the list of users with a success message
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Promote a user as an administrator (admin).
     */
    public function promote(User $user)
    {
        // Attach the admin role to the user
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $user->roles()->attach($adminRole);
        }

        // Redirect back to the list of users with a success message
        return redirect()->route('admin.users.index')->with('success', 'User promoted to admin successfully.');
    }
}
