<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package App\Models
 *
 * @property \App\Models\BlogCategory $category
 * @property \App\Models\User $user
 * @property string $title
 * @property string $slug
 * @property string $content_html
 * @property string $content_raw
 * @property string $excerpt
 * @property string $published_at
 * @property boolean $is_published
 *
 */
class BlogPost extends Model
{
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable
        = [
            'title',
            'slug',
            'category_id',
            'excerpt',
            'content_raw',
            'is_published',
            'published_at',
        ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class,'category_id','id');
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

