<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approve_deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'balance',
        'total_deposit',
        'user_id',
       
    ];
}
