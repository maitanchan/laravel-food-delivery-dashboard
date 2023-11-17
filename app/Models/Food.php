<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId', 'title', 'desc',  'totalStars', 'starNumber', 'cat', 'price', 'cover', 'shortTitle', 'shortDesc', 'deliveryTime', 'approve'
    ];
}
