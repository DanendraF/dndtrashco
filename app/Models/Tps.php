<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'location',
        'description',
        'open_time',
        'close_time',
        'link_maps',
        'slug'
    ];
}
