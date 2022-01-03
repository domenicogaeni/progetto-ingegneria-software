<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAuthToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    public static function getValidationRules()
    {
        return [
            'register' => [
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:12',
                'phone' => 'required|string|max:255',
            ],
            'login' => [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:12',
            ],
        ];
    }

    /**
     * Register new user.
     *
     * @param Request $request
     *
     * @return User
     */
    public function register(Request $request)
    {
        $params = $request->only(['name', 'last_name', 'email', 'password', 'phone']);

        return DB::transaction(function () use ($params) {
            $user = new User();
            $user->fill($params);
            $user->password = Hash::make($params['password']);
            $user->save();

            UserAuthToken::create([
                'auth_token' => md5(Str::random(255)),
                'expired_at' => date('Y-m-d H:i:s', strtotime('+1 days')),
                'user_id' => $user->id,
            ]);

            return User::find($user->id);
        });
    }

    /**
     * Login.
     *
     * @param Request $request
     *
     * @return User
     */
    public function login(Request $request)
    {
        $params = $request->only(['email', 'password']);

        $user = User::where('email', $params['email'])->first();

        if (!$user) {
            abort(401, 'User not found');
        }

        if (!Hash::check($params['password'], $user->password)) {
            abort(401, 'Wrong password');
        }

        $authToken = UserAuthToken::where('user_id', $user->id)
            ->where('expired_at', '>', date('Y-m-d H:i:s'))
            ->first();

        if (!$authToken) {
            $authToken = UserAuthToken::create([
                'auth_token' => md5(Str::random(255)),
                'expired_at' => date('Y-m-d H:i:s', strtotime('+1 days')),
                'user_id' => $user->id,
            ]);
        } else {
            $authToken->auth_token = md5(Str::random(255));
            $authToken->expired_at = date('Y-m-d H:i:s', strtotime('+1 days'));
            $authToken->save();
        }

        return User::find($user->id);
    }

    /**
     * Return current user.
     */
    public function me()
    {
        return User::find(Auth::user()->id);
    }

    /**
     * Logout user: delete auth token.
     */
    public function logout()
    {
        $authToken = UserAuthToken::where('user_id', Auth::user()->id)
            ->where('expired_at', '>', date('Y-m-d H:i:s'))
            ->first();

        if ($authToken) {
            $authToken->delete();
        }

        return 'Logout success';
    }
}
