<?php

namespace App\Http\Middleware;

use App\Credentials;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class StatelessBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->authenticate() ?: $next($request);
    }

    private function authenticate() {

        try {
            $credentials = Credentials::find($_SERVER['PHP_AUTH_USER']);
            if(Hash::check($_SERVER['PHP_AUTH_PW'], $credentials->password)) {
                Auth::loginUsingId($credentials->user->id);
                Auth::setUser($credentials->user);

                return null;
            }
        } catch (\Exception $exception) {}
        throw new UnauthorizedException();
    }
}
