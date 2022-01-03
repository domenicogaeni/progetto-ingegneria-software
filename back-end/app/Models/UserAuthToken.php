<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuthToken extends Model
{
    use HasFactory;

    protected $table = 'users_auth_tokens';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
