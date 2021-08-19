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
        // If this is not an exchange request
        if (! session('auth.exchange') ) {
            // Set intended url for redirecting user to previous page
            redirect()->setIntendedUrl(url()->previous());
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

        // Get back the requested parameters from frontend, and send to our OAuth server (Laravel Passport)
        if (session('auth.exchange') === 'github') {
            $query = http_build_query([
                'client_id' => session('auth.client_id'),
                'redirect_uri' => session('auth.redirect_uri'),
                'response_type' => session('auth.response_type'),
                'scope' => session('auth.scope'),
                'state' => session('auth.state'),
            ]);

            // Clean up the auth.* session
            session()->forget('auth');

            return redirect('/oauth/authorize?' . $query); // Should be redirected to redirect_uri provided by frontend application with OAuth code
        }

        // Redirect to intended url or `/`
        return redirect()->intended('/');
    }

    public function handleGithubAuthExchange(Request $request)
    {
        // Simple verification for the oauth client id
        if (! \DB::table('oauth_clients')
                ->where('id', request('client_id'))
                ->exists() )
        {
            return abort(403, 'invalid_client_id');
        }

        // Put the parameters into sessions, get back those values after successful of github login
        session([
            'auth.exchange' => 'github',
            'auth.client_id' => request('client_id'),
            'auth.redirect_uri' => request('redirect_uri'),
            'auth.response_type' => request('response_type'),
            'auth.scope' => request('scope'),
            'auth.state' => request('state'),
        ]);

        return $this->handleGithubAuth($request);
    }

}
