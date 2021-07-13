<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use File;

class DocController extends Controller
{
    public function index()
    {
        $path = storage_path('app/public/doc.md');

        return Inertia::render('Apply/Index', ['content' => File::get($path)]);
    }
}
