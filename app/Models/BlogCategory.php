<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * get parent's category
     *
     * @return BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * exzample of accessor => getSmthAttribute
     *
     * @url https://laravel.com/docs/6/eloquent-mutators
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
