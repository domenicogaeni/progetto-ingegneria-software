<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'vote' => [
                'vote' => 'required|integer|min:1|max:5',
                'description' => 'filled|string|max:255',
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

        return Book::where(DB::raw('LOWER(title)'), 'like', '%' . strtolower($params['value']) . '%')
            ->orWhere(DB::raw('LOWER(isbn)'), 'like', '%' . strtolower($params['value']) . '%')
            ->orWhere(DB::raw('LOWER(authors)'), 'like', '%' . strtolower($params['value']) . '%')
            ->orWhere(DB::raw('LOWER(gender)'), 'like', '%' . strtolower($params['value']) . '%')
            ->get();
    }

    /**
     * Get list of my books currently on sale.
     *
     * @return Book[]
     */
    public function getMyBooksCurrentlyOnSale()
    {
        $user = Auth::user();

        return Book::where('user_id', $user->id)
            ->get();
    }

    /**
     * Function to vote a book.
     *
     * @param Request $request
     * @param int     $id
     */
    public function vote(Request $request, int $id)
    {
        $book = Book::find($id);
        if (!$book) {
            abort(404, 'Book not found');
        }

        // Check that user is not the reseller of the book.
        if ($book->user_id == Auth::user()->id) {
            abort(403, 'You cannot vote for your own book');
        }

        BookReview::where('book_id', $id)
            ->where('user_id', Auth::user()->id)
            ->delete();

        $review = new BookReview();
        $review->book_id = $id;
        $review->user_id = Auth::user()->id;
        $review->fill($request->only(['vote', 'description']));

        $review->save();
    }
}
