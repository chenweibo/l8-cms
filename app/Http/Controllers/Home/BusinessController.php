<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
