<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
        
            $response = Http::post(env('APP_URL_API') . '/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['token']['token'])) {
                session(['auth_token' => $data['token']['token']]);
                return redirect()->route('home.index');
            }

            return back()->withErrors(['login_error' => 'Invalid credentials']);
        
        } catch (\Exception $e) {
            return back()->withErrors(['login_error' => 'Server error: ' . $e->getMessage()]);
        }

    }

    public function registration(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
        
            $response = Http::post(env('APP_URL_API') . '/auth/registration', [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['token']['token'])) {
                session(['auth_token' => $data['token']['token']]);
                return redirect()->route('home.index');
            }

            return back()->withErrors(['registration_error' => 'Registration failed']);
        
        } catch (\Exception $e) {
            return back()->withErrors(['registration_error' => 'Server error: ' . $e->getMessage()]);
        }

    }

    public function logout()
    {

        Http::post(env('APP_URL_API') . '/auth/logout')

    }

}