<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BlogPost;

class BlogPostMarker extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'title',
        ];

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            BlogPost::class,
            'post_marker',
            'post_id',
            'marker_id',
            'id',
            'id'
        );
    }
}
