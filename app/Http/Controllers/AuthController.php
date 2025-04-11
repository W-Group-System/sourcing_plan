<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function systemMenu()
    {
        return view('menu'); 
    }

    public function redirectToSystem($system)
    {
        $user = auth()->user();

        if ($system === 'system1') {
            return redirect('/home');
        } elseif ($system === 'system2') {
            return redirect("http://localhost/complete-monitoring/public/login-with-token?token={$user->api_token}");
        }

        return redirect()->route('system.menu')->with('error', 'Invalid selection.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $cookie = cookie('shared_session_cookie', '', -1, '/', '.localhost', false, true);

        return redirect('http://localhost/complete-monitoring/public/logout')->withCookie($cookie);
    }

}
