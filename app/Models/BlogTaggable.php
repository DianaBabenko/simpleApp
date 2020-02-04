<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogTaggable
 * @package App\Models
 */
class BlogTaggable extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type',
    ];


}
