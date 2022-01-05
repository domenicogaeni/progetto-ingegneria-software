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

        /** @var User $user */
        $user = User::factory()->create();
        $book = Book::factory()->create([
            'user_id' => $user->id,
        ]);
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
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ],
                'average_vote' => null,
                'book_reviews' => [],
            ]],
        ]);

        $this->get('book');
        $this->seeStatusCode(422);

        $this->refreshApplication();

        $this->get('book?' . http_build_query([
            'value' => $book->title,
        ]));
        $this->seeStatusCode(401);
    }
}