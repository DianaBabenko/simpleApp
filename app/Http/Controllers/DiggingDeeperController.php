<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

/**
 * Class DiggingDeeperController
 * @package App\Http\Controllers
 */
class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

        //dd(__METHOD__, $eloquentCollection);

        $collection = collect($eloquentCollection->toArray());

        /*dd(
            get_class($eloquentCollection),
            get_class($collection),
            $collection
        );*/
    }
}
