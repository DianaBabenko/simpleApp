<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class BlogPost
 * @package App\Models
 *
 * @property BlogCategory $category
 * @property User $user
 * @property int id
 * @property string title
 * @property string slug
 * @property string content_html
 * @property string $content_raw
 * @property string $excerpt
 * @property \DateTime $published_at
 * @property boolean $is_published
 * @property int category_id
 * @property int user_id
 *
 */
class BlogPost extends Model
{
    use SoftDeletes;

    public const UNKNOWN_USER = 1;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class,'category_id','id');
    }

    /**
     * @return MorphOne
     */
    public function tag(): MorphOne
    {
        return $this->morphOne(BlogTag::class, 'taggable');
    }

    /**
     * @return MorphMany
     */
    public function tags(): MorphMany
    {
        return $this->morphMany(BlogTag::class, 'taggable');
    }

    /**
     * @return MorphToMany
     */
    public function tagsToMany(): MorphToMany
    {
        return $this->morphToMany(BlogTag::class, 'taggable', 'blog_taggables', 'taggable_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function markers(): BelongsToMany
    {
        return  $this->belongsToMany(
            BlogPostMarker::class,
            'post_marker',
            'post_id',
            'marker_id',
            'id',
            'id'
        );
    }

    /**
     * Author of post
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

