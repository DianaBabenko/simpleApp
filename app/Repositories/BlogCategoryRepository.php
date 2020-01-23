<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;


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
    public function getEdit($id) {
        return $this->startConditions()->find($id);
    }

    /**
     * get list of category for combobox list
     * @return Collection
     */
    public function getForComboBox() {
        return $this->startConditions()->all();
    }
}
