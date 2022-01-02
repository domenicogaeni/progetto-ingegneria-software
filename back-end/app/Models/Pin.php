<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model 
{
    use HasFactory;

    protected $table = 'pins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pin',        
    ];    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
