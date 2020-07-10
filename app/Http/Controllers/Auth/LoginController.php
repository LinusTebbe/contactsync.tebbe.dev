<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Google_Service_People;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->setScopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return RedirectResponse
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        User::updateOrCreate([
                'id' => $user->getId(),
            ],[
                'id' => $user->getId(),
                'avatar' => $user->getAvatar(),
                'access_token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
            ]
        );

        return redirect(route('home'));
    }
}
