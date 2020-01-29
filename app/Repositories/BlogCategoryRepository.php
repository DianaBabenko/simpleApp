<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


/**
 * Class BlogCategoryRepository
 *
 * @packege App\Repositories
 */
class BlogCategoryRepository extends CoreRepository {

    /**
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }

    //get model for editing
    /**
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        $posts =  $this->startConditions()
            ->with(['posts'])
            ->get();

        return $posts;
    }

    /**
     * get list of category for combobox list
     * @return Collection
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, title) AS id_title',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * get category for view paginator
     * @param int|null $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null) {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([
                'parentCategory:id,title',
            ])
            ->paginate($perPage);
        return $result;
    }
}
