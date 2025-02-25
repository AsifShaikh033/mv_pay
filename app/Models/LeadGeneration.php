<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadGeneration extends Model
{
    use HasFactory;

   
    protected $table = 'lead_generation';

    
    protected $fillable = [
        'user_id',
        'type',
        'account_type',
        'url'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
