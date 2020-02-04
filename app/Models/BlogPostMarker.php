<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class BlogPostMarker
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 */
class BlogPostMarker extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
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
