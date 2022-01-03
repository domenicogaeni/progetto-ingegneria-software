<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerReview extends Model
{
    use HasFactory;

    protected $table = 'reseller_reviews';

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

    public function reviewed()
    {
        return $this->belongsTo(User::class, 'user_id_reviewed', 'id');
    }
}
