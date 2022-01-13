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
                'buyer_info' => [
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ],
            ],
        ]);

        $this->seeInDatabase('orders', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'address_id' => $address->id,
        ]);
    }

    public function testGetMyOrders()
    {
        $this->refreshApplication();

        /** @var User $reseller */
        $reseller = User::factory()->create();
        $bookReseller = Book::factory()->create([
            'user_id' => $reseller->id,
        ]);
        $addressReseller = Address::factory()->create([
            'user_id' => $reseller->id,
        ]);

        /** @var User $user */
        $user = User::factory()->create();
        $bookUser = Book::factory()->create([
            'user_id' => $user->id,
        ]);
        $addressUser = Address::factory()->create([
            'user_id' => $user->id,
        ]);

        Order::factory()->create([
            'user_id' => $user->id,
            'book_id' => $bookReseller->id,
            'address_id' => $addressUser->id,
        ]);

        Order::factory()->create([
            'user_id' => $reseller->id,
            'book_id' => $bookUser->id,
            'address_id' => $addressReseller->id,
        ]);

        $this->actingAs($reseller);
        $this->get('order');
        $this->seeStatusCode(200);

        $response = json_decode($this->response->original)->data;
        $this->seeJson([
            'data' => [
                'bought_books' => [
                    [
                        'id' => $response->bought_books[0]->id,
                        'status' => $response->bought_books[0]->status,
                        'created_at' => $response->bought_books[0]->created_at,
                        'book_info' => [
                            'id' => $bookUser->id,
                            'title' => $bookUser->title,
                            'isbn' => $bookUser->isbn,
                            'authors' => $bookUser->authors,
                            'price' => $bookUser->price,
                            'description' => $bookUser->description,
                            'gender' => $bookUser->gender,
                            'reseller_info' => [
                                'name' => $user->name,
                                'last_name' => $user->last_name,
                                'email' => $user->email,
                            ],
                        ],
                        'address' => $addressReseller->address,
                        'buyer_info' => [
                            'name' => $reseller->name,
                            'last_name' => $reseller->last_name,
                            'email' => $reseller->email,
                        ],
                    ],
                ],
                'sold_books' => [
                    [
                        'id' => $response->sold_books[0]->id,
                        'status' => $response->sold_books[0]->status,
                        'created_at' => $response->sold_books[0]->created_at,
                        'book_info' => [
                            'id' => $bookReseller->id,
                            'title' => $bookReseller->title,
                            'isbn' => $bookReseller->isbn,
                            'authors' => $bookReseller->authors,
                            'price' => $bookReseller->price,
                            'description' => $bookReseller->description,
                            'gender' => $bookReseller->gender,
                            'reseller_info' => [
                                'name' => $reseller->name,
                                'last_name' => $reseller->last_name,
                                'email' => $reseller->email,
                            ],
                        ],
                        'address' => $addressUser->address,
                        'buyer_info' => [
                            'name' => $user->name,
                            'last_name' => $user->last_name,
                            'email' => $user->email,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
