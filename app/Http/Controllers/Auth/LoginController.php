<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function logout(Request $request)
    {
        if (strpos($request->header('accept'), 'text/html') !== false) {
            \Auth::logout();
        }
        return redirect()->to('/');
    }

}
