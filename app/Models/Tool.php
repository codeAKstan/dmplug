<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'category',
        'sub_category',
        'name',
        'image',
        'price',
        'description',
        'status',
    ];
}
