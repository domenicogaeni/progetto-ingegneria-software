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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'book_id',
        'user_id',
        'id',
    ];

    /**
     * The attributes that should be append to array.
     *
     * @var array
     */
    protected $appends = [
        'user_info',
    ];

    /**
     * Get basic user info.
     *
     * @return array
     */
    public function getUserInfoAttribute()
    {
        $user = $this->reviewer()->first();

        return [
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ];
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book_reviewed()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
