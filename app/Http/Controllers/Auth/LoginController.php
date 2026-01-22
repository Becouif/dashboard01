<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index(Request $request) 
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');

    }
}
