<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

abstract class BasePublicController extends Controller
{
    /**
     */
    public $locale;

    public function __construct()
    {
        $this->locale = App::getLocale();
    }
}
