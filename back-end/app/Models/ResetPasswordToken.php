<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordToken extends Model 
{
    use HasFactory;

    protected $table = 'reset_password_tokens';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
