<?php

use App\Models\Address;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;

/**
 * @internal
 */
class OrderTest extends TestCase
{
    /**
     * Test create new order.
     */
    public function testNewOrder()
    {
        /** @var User $reseller */
        $reseller = User::factory()->create();
        /** @var User $user */
        $user = User::factory()->create();

        $book = Book::factory()->create([
            'user_id' => $reseller->id,
        ]);
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $this->notSeeInDatabase('orders', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'address_id' => $address->id,
        ]);

        $this->post('order', [
            'book_id' => $book->id,
            'address' => $address->address,
        ]);
        $this->seeStatusCode(200);
        $response = json_decode($this->response->original)->data;
        $this->seeJson([
            'data' => [
                'id' => $response->id,
                'status' => Order::STATUS_PENDING,
                'created_at' => $response->created_at,
                'book_info' => [
                    'id' => $book->id,
                    'title' => $book->title,
                    'isbn' => $book->isbn,
                    'authors' => $book->authors,
                    'price' => $book->price,
                    'description' => $book->description,
                    'gender' => $book->gender,
                    'reseller_info' => [
                        'name' => $reseller->name,
                        'last_name' => $reseller->last_name,
                        'email' => $reseller->email,
                    ],
                ],
                'address' => $address->address,
            ],
        ]);

        $this->seeInDatabase('orders', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'address_id' => $address->id,
        ]);
    }
}
