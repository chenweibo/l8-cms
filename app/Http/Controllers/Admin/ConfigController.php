<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    public function optimization()
    {
        $result = Artisan::call('config:cache');
        $result2 = Artisan::call('route:cache');
        $result3 = Artisan::call('view:cache');

    }

    public function clearOptimization()
    {

    }

}
