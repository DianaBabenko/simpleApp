<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPostComment extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'title',
            'user_id',
        ];
}
