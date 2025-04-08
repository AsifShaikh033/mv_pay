<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'charge',
        'after_charge',
        'status',
        'comment',
        'details',
        'transaction_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bank()
    {
        return $this->hasOne(Bankdetail::class, 'user_id', 'user_id');
    }
}
