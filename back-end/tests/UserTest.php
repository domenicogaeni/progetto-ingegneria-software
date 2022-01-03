<?php

use App\Models\User;

/**
 * @internal
 */
class UserTest extends TestCase
{
    public function testNewUser()
    {
        $name = 'John';
        $lastName = 'Doe';
        $phone = '+380991234567';
        $email = 'test@example.com';
        $pwd = 'passwordlunga';

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
            'password' => $pwd,
            'phone' => $phone,
        ])
            ->seeStatusCode(200);

        $this->seeJsonStructure(
            ['data' => [
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
            ]
        );

        $this->seeInDatabase('users', [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
        ]);
    }

    public function testDuplicatedUser()
    {
        $name = 'John';
        $lastName = 'Doe';
        $phone = '+380991234567';
        $email = 'test@example.com';
        $pwd = 'passwordlunga';

        $this->post('auth/register', [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $pwd,
            'phone' => $phone,
        ])
            ->seeStatusCode(422);
    }
}
