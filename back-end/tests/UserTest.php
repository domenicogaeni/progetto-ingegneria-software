<?php

use App\Models\Address;
use App\Models\CreditMethod;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UserAuthToken;
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
        $address = Address::factory()->raw()['address'];
        $cardNumber = PaymentMethod::factory()->raw()['card_number'];
        $iban = CreditMethod::factory()->raw()['iban'];

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
            'address' => $address,
            'card_number' => $cardNumber,
            'iban' => $iban,
        ]);
        $this->seeStatusCode(200);
        $response = json_decode($this->response->original)->data;

        $this->seeJson([
            'data' => [
                'id' => $response->id,
                'name' => $name,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'auth_token' => [
                    'auth_token' => $response->auth_token->auth_token,
                    'expired_at' => $response->auth_token->expired_at,
                ],                
                'card_number' => $cardNumber,
                'iban' => $iban,
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
        $userOne = User::factory()->create();

        $user = User::factory()->raw();
        $name = $user['name'];
        $lastName = $user['last_name'];
        $password = $user['password'];
        $phone = $user['phone'];

        $this->post('auth/register', [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $userOne->email,
            'password' => $password,
            'phone' => $phone,
        ]);
        $this->seeStatusCode(422);
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
                    'address',
                    'auth_token' => [
                        'auth_token',
                        'expired_at',
                    ],
                    'card_number',
                    'iban',
                ],
            ]);

        $this->post('auth/login', ['email' => $user->email, 'password' => 'wrongPasswordMaSempreLunga'])
            ->seeStatusCode(401);

        $this->post('auth/login', ['email' => 'wrong@email.com', 'password' => $password])
            ->seeStatusCode(401);
    }

    /**
     * Test call /auth/me.
     */
    public function testMe()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);

        $this->get('auth/me')
            ->seeStatusCode(200)
            ->seeJson([
                'data' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'last_name' => $user->last_name,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'auth_token' => null,
                    'address' => $address->address,
                    'card_number' => null,
                    'iban' => null,
                ],
            ]);
    }

    /**
     * Test logout call.
     */
    public function testLogout()
    {
        $this->refreshApplication();

        $user = User::factory()->create();
        $token = UserAuthToken::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->post('auth/logout', [], ['Authorization' => 'Bearer ' . $token->auth_token])
            ->seeStatusCode(200)
            ->seeJson(['data' => 'Logout success']);

        $this->refreshApplication();

        $this->post('auth/logout', [], ['Authorization' => 'Bearer ' . $token->auth_token])
            ->seeStatusCode(401);
    }
}
