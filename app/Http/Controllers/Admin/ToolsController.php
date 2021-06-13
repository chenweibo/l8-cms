<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;

class ToolsController extends Controller
{
    public function clearCache(): array
    {
        modifyEnv([
            'APP_ENV' => 'local',
            'APP_DEBUG' => 'true',
        ]);

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return ['messages' => 'ok'];
    }

    public function cache()
    {
        modifyEnv([
            'APP_ENV' => 'production',
            'APP_DEBUG' => 'false',
        ]);
        Artisan::call('config:cache');
        Artisan::call('route:cache');

        return ['messages' => 'ok'];
    }

    public function createLink(): array
    {
        Artisan::call('storage:link');

        return ['messages' => 'ok'];
    }
}
