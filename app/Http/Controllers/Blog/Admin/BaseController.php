<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Blog\BaseController as GuestBaseController;

class BaseController extends GuestBaseController
{
    /**
     * BaseController constructor.
     */
    public function __construct() {
        //initialization common properties for adminP
    }
}
