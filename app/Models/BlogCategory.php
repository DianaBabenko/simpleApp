<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 *
 * @package App\Models
 *
 */

 /**
 * @property int $id
 * @property string title
 * @property string slug
 * @property string description
 * @property-read BlogCategory $parentCategory
 * @property-read string $parentTitle
 *
 * @OA\Schema(
 *   schema="BlogCategory",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *          required={"title", "slug", "description"},
 *          @OA\Property(property="title", format="string", type="string"),
 *          @OA\Property(property="slug", format="string", type="string"),
 *          @OA\Property(property="description", format="string", type="string"),
 *       )
 *   }
 * )
 */
class BlogCategory extends Model
{
    public $timestamps = false;

    /** Id of root*/
    public const DEFAULT_CATEGORY = 1;

    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class,'category_id','id');
    }

    /**
     * get parent's category
     *
     * @return BelongsTo
     */
    public function parentCategory(): BelongsTo/////
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
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
        return $this->morphMany(BlogTag::class, 'taggable', 'blog_taggable', '');
    }
}
