<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BlogPost;
use App\Models\BlogTag;

/**
 * Class BlogCategory
 *
 * @package App\Models
 *
 * @property-read BlogCategory $parentCategory
 * @property-read string $parentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    /**
     * Id of root
     */
    const ROOT = 1;

    protected $fillable
        = [
            'title',
            'slug',
            'parent_id',
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
    public function parentCategory()
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
     * exz of accessor => getSmthAttribute
     *
     *
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
            ? 'Корень'
            : '???');

        return $title;
    }

    /**
     * if the current object is root
     * @return bool
     */
    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }
}
