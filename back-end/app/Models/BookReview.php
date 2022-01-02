<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    use HasFactory;

    protected $table = 'book_reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'vote',
    ];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book_reviewed()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
