<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class BlogTag
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property int $taggable_id
 * @property int $taggable_type
 */
class BlogTag extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'taggable_id',
        'taggable_type',
    ];

    /**
     * @return MorphTo
     */
    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return MorphToMany
     */
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(BlogPost::class, 'taggable','blog_taggables', 'taggable_id', 'id');
    }

    /**
     * @return MorphToMany
     */
    public function categories(): MorphToMany
    {
        return $this->morphedByMany(BlogCategory::class, 'taggable','blog_taggables', 'taggable_id', 'id');
    }
}
