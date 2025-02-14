<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use HasFactory;

    protected $table = 'recharges'; 

    protected $fillable = [
        'user_id',
        'number',
        'serviceType',
        'operator',
        'circle',
        'amount',
        'user_tx',
        'status',
        'format',
        'api_response',
    ];

    protected $casts = [
        'api_response' => 'json',
    ];

    /**
     * Relationship with User model (if applicable)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
