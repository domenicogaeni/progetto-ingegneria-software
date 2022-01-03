<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAuthToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
            ]
        ];
    }
    
    /**
     * Register new user.
     *
     * @param  Request $request
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
                'auth_token' => Hash::make(Str::random(255)),
                'expired_at' => date('Y-m-d H:i:s', strtotime('+1 days')),
                'user_id' => $user->id,
            ]);
    
            return User::find($user->id);
        });
    }
}
