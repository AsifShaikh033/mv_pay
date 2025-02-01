<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceCashback extends Model
{
    protected $fillable = ['balance', 'cashback', 'category', 'status'];
}
