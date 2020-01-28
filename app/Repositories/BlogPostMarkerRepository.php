<?php

namespace App\Repositories;

use App\Models\BlogPostMarker as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogPostMarkerRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }


    /**
     * @return Collection
     */
    public function getPosts():Collection
    {
        $posts =  $this->startConditions()
            ->with(['posts'])
            ->get();

        return $posts;
    }
}
