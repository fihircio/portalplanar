<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'role' => 'required|in:admin,staff', // Ensure the role is either admin or staff
        ]);

        // Update the user's role
        $user->role()->associate($request->role)->save();

        // Redirect back to the user index page with a success message
        return redirect()->route('users.index')->with('success', 'User role updated successfully.');
    }
}

