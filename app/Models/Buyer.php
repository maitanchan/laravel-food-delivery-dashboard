<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'email', 'password',  'img', 'country', 'phone', 'desc', 'isSeller'
    ];
}
