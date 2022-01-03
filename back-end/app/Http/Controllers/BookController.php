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
        Book::create([
            'title' => $params['title'],
            'isbn' => $params['isbn'],
            'authors' => $params['authors'],
            'price' => $params['price'],
            'description' => isset($params['description']) ? $params['description'] : null,
            'gender' => $params['gender'],
            'user_id' => Auth::user()->id,
        ]);
    }
    
    /**
     * Delete a book.
     *
     * @param  int $id
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
}
