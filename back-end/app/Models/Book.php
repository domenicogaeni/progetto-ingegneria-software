<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'isbn',
        'authors',
        'price',
        'description',
        'gender',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
    ];

    /**
     * The attributes that should be append to array.
     *
     * @var array
     */
    protected $appends = [
        'reseller_info',
        'average_vote',
    ];

    /**
     * Relationship to show in toArray.
     *
     * @var array
     */
    protected $with = [
        'book_reviews',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    /**
     * Get basic reseller info.
     */
    public function getResellerInfoAttribute()
    {
        $user = $this->user()->first();

        return [
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ];
    }

    /**
     * Get average vote of reviews.
     */
    public function getAverageVoteAttribute()
    {
        $reviews = $this->book_reviews()->get();

        return $reviews->avg('vote') > 0 ? number_format($reviews->avg('vote'), 1, ',') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'book_id');
    }

    public function book_reviews()
    {
        return $this->hasMany(BookReview::class, 'book_id');
    }
}
