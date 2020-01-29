<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTaggable extends Model
{
    public $timestamps = false;

    protected $fillable
        = [
            'tag_id',
            'taggable_id',
            'taggable_type',
        ];


}
