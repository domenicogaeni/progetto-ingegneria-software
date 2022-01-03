<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserAuthToken;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Boot the authentication services for the application.
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->bearerToken()) {
                $idTokenString = $request->bearerToken();
                $token = UserAuthToken::where('auth_token', $idTokenString)
                    ->where('expired_at', '>', date('Y-m-d H:i:s'))
                    ->first();
                if (!$token) {
                    return null;
                }

                return User::find($token->user_id);
            }
        });
    }
}
