<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Models\Config;
use Illuminate\Support\Facades\View;
use Schema;

class BaseInfoComposer
{
    /**
     *  将数据绑定到视图。
     *
     * @param View $view
     * @return void
     */
    public function compose()
    {
        if (Schema::hasTable('configs')) {
            $basic = Config::where('type', 'basic')->get();
            View::share('system', handleDetailFormat($basic[0]->options));
        }

        View::share('menu', Category::orderBy('sort', 'asc')->get()->toTree());
    }
}
