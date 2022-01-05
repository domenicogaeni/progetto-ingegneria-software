<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_DONE = 'done';

    protected $hidden = [
        'user_id',
        'updated_at',
        'book_id',
        'address_id',
    ];

    protected $appends = [
        'book_info',
        'address',
        'buyer_info',
    ];

    public function getAddressAttribute()
    {
        return $this->address()->first()->address;
    }

    public function getBookInfoAttribute()
    {
        $book = $this->book()->first();

        return [
            'id' => $book->id,
            'title' => $book->title,
            'isbn' => $book->isbn,
            'authors' => $book->authors,
            'price' => $book->price,
            'description' => $book->description,
            'gender' => $book->gender,
            'reseller_info' => $book->reseller_info,
        ];
    }

    public function getBuyerInfoAttribute ()
    {
        $user = $this->user()->first();
        return [
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
