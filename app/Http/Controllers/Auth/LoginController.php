<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $client = new Client();
        $response = $client->post(ENV('APP_URL_API') . '/auth/login', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['token'])) {
            session(['token' => $data['token']]);
            return redirect()->route('board');
        }

        return back()->withErrors(['login_error' => 'Invalid credentials']);
    }

    function registration(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $client = new Client();
        $response = $client->post(ENV('APP_URL_API') . '/auth/registration', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['token'])) {
            session(['token' => $data['token']]);
            return redirect()->route('board');
        }

        return back()->withErrors(['registration_error' => 'Registration failed']);
        
    }
}
