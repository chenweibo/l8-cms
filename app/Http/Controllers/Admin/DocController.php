<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocController extends Controller
{
    public function index()
    {
        $path = storage_path('app/public/doc.md');

        return Inertia::render('Apply/Index', ['content' => File::get($path)]);
    }
}
