<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankdetail extends Model
{
    use HasFactory;
    protected $table= 'bank_details';
    
    protected $fillable = [
        'user_id',
        'upi_id',
        'account_holder_name',
        'bank_name',
        'branch_name',
        'ifsc_code',
        'account_number',
        'barcode',
        'status',
    ];
}
