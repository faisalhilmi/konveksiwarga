<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentWork extends Model
{
    protected $table = 'recent_works';

    protected $fillable = ['title', 'url', 'description', 'alt', 'image', 'active'];

}
