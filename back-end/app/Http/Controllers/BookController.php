<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends BaseController
{
    public static function getValidationRules()
    {
        return [
            'new' => [
                'title' => 'required|string|max:255',
                'isbn' => 'required|string|max:255',
                'authors' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'filled|string|max:255',
                'gender' => 'required|string|max:255',
            ],
            'search' => [
                'value' => 'required|string',
            ],
        ];
    }

    /**
     * Function to create new book.
     *
     * @param Request $request
     */
    public function new(Request $request)
    {
        $params = $request->only(['title', 'isbn', 'authors', 'price', 'description', 'gender']);
        $book = Book::create([
            'title' => $params['title'],
            'isbn' => $params['isbn'],
            'authors' => $params['authors'],
            'price' => $params['price'],
            'description' => isset($params['description']) ? $params['description'] : null,
            'gender' => $params['gender'],
            'user_id' => Auth::user()->id,
        ]);

        return Book::find($book->id);
    }

    /**
     * Delete a book.
     *
     * @param int $id
     */
    public function delete($id)
    {
        $book = Book::where('user_id', Auth::user()->id)
            ->find($id);
        if (!$book) {
            abort(404, 'Book not found');
        }
        $book->delete();
    }

    /**
     * Search a book.
     *
     * @param Request $request
     *
     * @return Book[]
     */
    public function search(Request $request)
    {
        $params = $request->only(['value']);

        return Book::where('title', 'like', '%' . $params['value'] . '%')
            ->orWhere('isbn', 'like', '%' . $params['value'] . '%')
            ->orWhere('authors', 'like', '%' . $params['value'] . '%')
            ->orWhere('gender', 'like', '%' . $params['value'] . '%')
            ->get();
    }
    
    /**
     * Get list of my books currently on sale.
     *
     * @return Book[]
     */
    public function getMyBooksCurrentlyOnSale ()
    {
        $user = Auth::user();
        $books = Book::where('user_id', $user->id)
            ->get();

        return $books;
    }
}
