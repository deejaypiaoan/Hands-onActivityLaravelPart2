<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function create()
    {
        return view('welcome'); // Use welcome view for user creation
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        // Create a new User instance and save to the database
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Hash the password
        ]);

        return redirect()->route('user.create')->with('success', 'User created successfully!');
    }


    // Display the user dashboard with the authenticated user's details
    public function dashboard()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('dashboard', compact('user'));
    }

    // Show the edit form for the authenticated user
    public function edit()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('edit', compact('user')); // Create an 'edit' view for user details
    }

    // Update the authenticated user's details
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255', // Changed to string for mobile number
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Add debugging
        \Log::info('Updating user: ', $user->toArray());
        \Log::info('New data: ', $request->only(['name', 'email', 'age', 'address', 'mobile_number']));

        // Update the user information
        $updated = $user->update($request->only(['name', 'email', 'age', 'address', 'mobile_number']));

        // Check if the update was successful
        if ($updated) {
            return redirect()->route('dashboard')->with('success', 'Details Updated!'); // Pop-up message
        } else {
            return redirect()->route('dashboard')->with('error', 'Failed to update details.'); // Error message
        }
    }




    // Change Password functionality
    public function changePassword(Request $request)
    {
        // Validate the form data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('dashboard')->with('error', 'Current password is incorrect.');
        }

        // Update the password
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Password changed successfully!');
    }




    // Delete the authenticated user's account
    public function destroy()
    {
        $user = Auth::user(); // Get the authenticated user
        $user->delete();

        return redirect()->route('user.create')->with('success', 'User deleted successfully!'); // Redirect to Create User page
    }
}
