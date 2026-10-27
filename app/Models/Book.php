<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // user_id is not fillable on purpose; it is assigned from the logged-in user
    protected $fillable = ['title', 'author', 'pages'];
}