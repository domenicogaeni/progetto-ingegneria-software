<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function pins()
    {
        return $this->hasMany(Pin::class, 'user_id');
    }

    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class, 'user_id');
    }    

    public function credit_methods()
    {
        return $this->hasMany(CreditMethod::class, 'user_id');
    }    

    public function reset_password_tokens()
    {
        return $this->hasMany(ResetPasswordToken::class, 'user_id');
    }
    
    public function books()
    {
        return $this->hasMany(Book::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function reseller_reviews_reviewer()
    {
        return $this->hasMany(ResellerReview::class, 'user_id');
    }

    public function reseller_reviews_reviewed()
    {
        return $this->hasMany(ResellerReview::class, 'user_id_reviewed');
    }

    public function book_reviews_reviewer()
    {
        return $this->hasMany(BookReview::class, 'user_id');
    }
}
