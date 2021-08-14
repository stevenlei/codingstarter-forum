<?php

namespace App\Http\Controllers\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SocialLoginController extends Controller
{
    //
    public function handleGithubAuth(Request $request)
    {
        if (\Auth::check()) {
            return redirect()->to('/');
        }

        return Socialite::driver('github')->scopes(['read:user'])->redirect();
    }

    public function handleGithubCallback(Request $request)
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::where('channel', 'github')->where('channel_user_id', $githubUser->id)->first();

        if (!$user) {
            // Register
            $user = new User;
        }

        // Update informations
        $user->name = $githubUser->nickname;
        $user->email = $githubUser->email;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = \Hash::make(\Str::random(32)); // random password
        $user->channel = 'github';
        $user->token = $githubUser->token;
        $user->channel_user_id = $githubUser->id;
        $user->profile_image_url = $githubUser->avatar;
        $user->save();

        \Auth::login($user);

        return redirect()->to('/');
    }

}
