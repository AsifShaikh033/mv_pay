<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'amount',
        'charge',
        'post_balance',
        'trx_type',
        'details',
        'remark',
        'status',
        'payment_status',
        'transaction_id',
        'response_msg',
    ];

    // The attributes that should be cast to native types.
    // protected $casts = [
    //     'amount' => 'decimal:2',
    //     'charge' => 'decimal:2',
    //     'post_balance' => 'decimal:2',
    //     'status' => 'integer',
    //     'payment_status' => 'string',
    // ];

    // Define the default values for the model.
    // protected $attributes = [
    //     'user_id' => null,
    //     'amount' => 0,
    //     'charge' => 0,
    //     'post_balance' => 0,
    //     'trx_type' => null,
    //     'details' => null,
    //     'remark' => null,
    //     'status' => 0,
    //     'payment_status' => null,
    //     'transaction_id' => null,
    //     'response_msg' => null,
    // ];

    // Optionally, you can add relationships, for example:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
