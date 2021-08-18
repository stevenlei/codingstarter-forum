<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function logout(Request $request)
    {
        // Set intended url for redirecting user to previous page
        redirect()->setIntendedUrl(url()->previous());

        if (strpos($request->header('accept'), 'text/html') !== false) {
            \Auth::logout();
        }

        return redirect()->intended('/');
    }

}
