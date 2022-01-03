<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @internal
 */
class UserTest extends TestCase
{
    /**
     * Test register new user.
     */
    public function testNewUser()
    {
        $user = User::factory()->raw();
        $name = $user['name'];
        $lastName = $user['last_name'];
        $email = $user['email'];
        $password = $user['password'];
        $phone = $user['phone'];

        $this->notSeeInDatabase('users', [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
        ]);

        $this->post('auth/register', [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
        ])
            ->seeStatusCode(200);

        $this->seeJsonStructure([
            'data' => [
                'id',
                'name',
                'last_name',
                'email',
                'phone',
                'auth_token' => [
                    'auth_token',
                    'expired_at',
                ],
            ],
        ]);

        $this->seeInDatabase('users', [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
        ]);
    }

    /**
     * Test register new user with existing email.
     */
    public function testDuplicatedUser()
    {
        $email = 'test@example.com';

        User::factory()->create([
            'email' => $email,
        ]);

        $user = User::factory()->raw();
        $name = $user['name'];
        $lastName = $user['last_name'];
        $password = $user['password'];
        $phone = $user['phone'];

        $this->post('auth/register', [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
        ])
            ->seeStatusCode(422);
    }

    /**
     * Test login, with correct credentials, incorrect password and incorrect email.
     */
    public function testLogin()
    {
        $password = 'passwordBellaLunga';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $this->post('auth/login', ['email' => $user->email, 'password' => $password])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'last_name',
                    'email',
                    'phone',
                    'auth_token' => [
                        'auth_token',
                        'expired_at',
                    ],
                ],
            ]);

        $this->post('auth/login', ['email' => $user->email, 'password' => 'wrongPasswordMaSempreLunga'])
            ->seeStatusCode(401);

        $this->post('auth/login', ['email' => 'wrong@email.com', 'password' => $password])
            ->seeStatusCode(401);
    }
}
