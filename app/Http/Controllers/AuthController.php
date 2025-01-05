<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // Handle login request
    public function authenticate(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Attempt login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    
            // Get the logged-in user
            $user = Auth::user();
    
            // Get roles and permissions for the user
            $roles = $user->roles;
            $permissions = [];
    
            foreach ($roles as $role) {
                $rolePermissions = $role->permissions;
                foreach ($rolePermissions as $permission) {
                    $permissions[] = $permission->name;
                }
            }
    
            // Store roles and permissions in session
            session([
                'roles' => $roles->pluck('name')->toArray(),
                'permissions' => $permissions,
            ]);
    
            // Flash success message to session
            session()->flash('success', 'Login successful.');
    
            // Redirect to the dashboard or desired route
            return redirect()->route('h'); // Change 'dashboard' to your desired route
        }
    
        // Authentication failed
        session()->flash('error', 'Invalid credentials. Please try again.');
    
        return redirect()->route('login');
    }
    

    // Logout and invalidate session
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flash success message to session for logout
        session()->flash('success', 'You have been logged out.');

        return redirect()->route('login');
    }
}
