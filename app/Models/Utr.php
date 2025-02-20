<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utr extends Model
{
    protected $fillable = ['image', 'status','details','utr_type'];
}
