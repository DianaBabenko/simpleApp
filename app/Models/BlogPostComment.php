<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPostComment
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property int $user_id
 */
class BlogPostComment extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
    ];
}
