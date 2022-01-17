<?php

use App\Models\Book;
use App\Models\User;

/**
 * @internal
 */
class BookTest extends TestCase
{
    /**
     * Test register new user.
     */
    public function testNewBook()
    {
        /** @var User */
        $user = User::factory()->create();
        $book = Book::factory()->raw();

        $this->actingAs($user);

        $this->notSeeInDatabase('books', [
            'title' => $book['title'],
            'isbn' => $book['isbn'],
            'description' => $book['description'],
            'authors' => $book['authors'],
            'gender' => $book['gender'],
            'price' => $book['price'],
            'user_id' => $user->id,
        ]);

        $this->post('book', [
            'title' => $book['title'],
            'isbn' => $book['isbn'],
            'description' => $book['description'],
            'authors' => $book['authors'],
            'gender' => $book['gender'],
            'price' => $book['price'],
        ]);
        $this->seeStatusCode(200);
        $response = json_decode($this->response->original)->data;
        $this->seeJson([
            'data' => [
                'id' => $response->id,
                'title' => $book['title'],
                'isbn' => $book['isbn'],
                'description' => $book['description'],
                'authors' => $book['authors'],
                'gender' => $book['gender'],
                'price' => $book['price'],
                'reseller_info' => [
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ],
                'average_vote' => null,
                'book_reviews' => [],
            ],
        ]);

        $this->seeInDatabase('books', [
            'title' => $book['title'],
            'isbn' => $book['isbn'],
            'description' => $book['description'],
            'authors' => $book['authors'],
            'gender' => $book['gender'],
            'price' => $book['price'],
            'user_id' => $user->id,
        ]);
    }

    public function testSearchBook()
    {
        $this->refreshApplication();

        /** @var User $reseller */
        $reseller = User::factory()->create();
        $book = Book::factory()->create([
            'user_id' => $reseller->id,
        ]);
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get('book?' . http_build_query([
            'value' => $book->title,
        ]));
        $this->seeStatusCode(200);
        $this->seeJson([
            'data' => [[
                'id' => $book->id,
                'title' => $book->title,
                'isbn' => $book->isbn,
                'description' => $book->description,
                'authors' => $book->authors,
                'gender' => $book->gender,
                'price' => $book->price,
                'reseller_info' => [
                    'name' => $reseller->name,
                    'last_name' => $reseller->last_name,
                    'email' => $reseller->email,
                ],
                'average_vote' => null,
                'book_reviews' => [],
            ]],
        ]);

        $this->get('book');
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'isbn',
                    'description',
                    'authors',
                    'gender',
                    'price',
                    'reseller_info' => [
                        'name',
                        'last_name',
                        'email'
                    ],
                    'average_vote',
                    'book_reviews'
                ]
            ]
        ]);        

        $this->refreshApplication();

        $this->get('book?' . http_build_query([
            'value' => $book->title,
        ]));
        $this->seeStatusCode(401);
    }

    /**
     * Test call to get my books currently on sale.
     */
    public function testGetMyBooksOnSale()
    {
        $this->refreshApplication();

        /** @var User $user */
        $user = User::factory()->create();
        $book1 = Book::factory()->create([
            'user_id' => $user->id,
        ]);
        $book2 = Book::factory()->create([
            'user_id' => $user->id,
        ]);
        $book3 = Book::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);

        $this->get('book/on_sale');
        $this->seeStatusCode(200);
        $this->seeJson([
            'data' => [
                [
                    'id' => $book1->id,
                    'title' => $book1->title,
                    'isbn' => $book1->isbn,
                    'description' => $book1->description,
                    'authors' => $book1->authors,
                    'gender' => $book1->gender,
                    'price' => $book1->price,
                    'reseller_info' => [
                        'name' => $user->name,
                        'last_name' => $user->last_name,
                        'email' => $user->email,
                    ],
                    'average_vote' => null,
                    'book_reviews' => [],
                ],
                [
                    'id' => $book2->id,
                    'title' => $book2->title,
                    'isbn' => $book2->isbn,
                    'description' => $book2->description,
                    'authors' => $book2->authors,
                    'gender' => $book2->gender,
                    'price' => $book2->price,
                    'reseller_info' => [
                        'name' => $user->name,
                        'last_name' => $user->last_name,
                        'email' => $user->email,
                    ],
                    'average_vote' => null,
                    'book_reviews' => [],
                ],
                [
                    'id' => $book3->id,
                    'title' => $book3->title,
                    'isbn' => $book3->isbn,
                    'description' => $book3->description,
                    'authors' => $book3->authors,
                    'gender' => $book3->gender,
                    'price' => $book3->price,
                    'reseller_info' => [
                        'name' => $user->name,
                        'last_name' => $user->last_name,
                        'email' => $user->email,
                    ],
                    'average_vote' => null,
                    'book_reviews' => [],
                ],
            ],
        ]);
    }

    public function testVoteABook()
    {
        $this->refreshApplication();

        /** @var User $user */
        $user = User::factory()->create();
        $book = Book::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);

        // Owener can't vote for his book.
        $this->post('book/' . $book->id . '/vote', [
            'vote' => 1,
            'description' => 'The book was a shit.',
        ]);
        $this->seeStatusCode(403);

        // Vote can't be 0
        $this->post('book/' . $book->id . '/vote', [
            'vote' => 0,
            'description' => 'The book was a shit.',
        ]);
        $this->seeStatusCode(422);

        $this->refreshApplication();
        /** @var User $user1 */
        $user1 = User::factory()->create();
        $this->actingAs($user1);
        $this->post('book/' . $book->id . '/vote', [
            'vote' => 2,
            'description' => 'The book was a shit.',
        ]);
        $this->seeStatusCode(200);

        $this->refreshApplication();
        /** @var User $user2 */
        $user2 = User::factory()->create();
        $this->actingAs($user2);
        $this->post('book/' . $book->id . '/vote', [
            'vote' => 4,
        ]);
        $this->seeStatusCode(200);

        // Check the average vote for the voting book.
        $this->get('book?' . http_build_query([
            'value' => $book->title,
        ]));
        $this->seeStatusCode(200);
        $this->seeJson([
            'data' => [[
                'id' => $book->id,
                'title' => $book->title,
                'isbn' => $book->isbn,
                'description' => $book->description,
                'authors' => $book->authors,
                'gender' => $book->gender,
                'price' => $book->price,
                'reseller_info' => [
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ],
                'average_vote' => '3,0',
                'book_reviews' => [
                    [
                        'vote' => 2,
                        'description' => 'The book was a shit.',
                        'user_info' => [
                            'name' => $user1->name,
                            'last_name' => $user1->last_name,
                            'email' => $user1->email,
                        ],
                    ],
                    [
                        'vote' => 4,
                        'description' => null,
                        'user_info' => [
                            'name' => $user2->name,
                            'last_name' => $user2->last_name,
                            'email' => $user2->email,
                        ],
                    ],
                ],
            ]],
        ]);
    }
}
