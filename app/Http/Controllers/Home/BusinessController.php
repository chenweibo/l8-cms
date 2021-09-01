<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class BusinessController extends Controller
{
    public function index()
    {
        return view('templates.index');
    }

    public function page()
    {
        return view('templates.index');
    }

    public function list()
    {
    }

    public function download()
    {
    }

    public function text()
    {
        $result = Artisan::call('config:cache');
    }
}
