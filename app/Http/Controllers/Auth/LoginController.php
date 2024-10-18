<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Show login form and pass data to view
    public function showLoginForm()
    {
        // Example data
        $organization = Organization::first();
        
        // Passing data to the view
        return view('auth.login', [
            'organization' => $organization
        ]);
    }
}
