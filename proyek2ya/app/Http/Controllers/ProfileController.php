<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.page.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.page.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to update your profile.');
        }

        // Debug statement to check the user instance
        if (!($user instanceof User)) {
            return redirect()->route('login')->with('error', 'Invalid user instance.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('user.page.profile.show')->with('success', 'Profile updated successfully!');
    }
}
