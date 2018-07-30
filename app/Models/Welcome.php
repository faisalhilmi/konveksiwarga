<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    protected $table = 'welcomes';

    protected $fillable = ['title', 'content', 'category', 'image', 'tags', 'url'];
}
