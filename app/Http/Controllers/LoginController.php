<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle post-login redirection based on user role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $users)
    {
        // Check the user's role and redirect accordingly
        if ($users->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($users->role === 'therapist') {
            return redirect()->route('therapist.dashboard');
        } elseif ($users->role === 'patient') {
            return redirect()->route('patients.dashboard');
        }

        // Default redirection if no role matches
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // This will call the authenticated method if successful
            return $this->authenticated($request, Auth::user());
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
