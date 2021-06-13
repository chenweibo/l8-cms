<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        return Inertia::render('File/Index');
    }

    /**
     * get views list
     *
     * @return array
     */
    public function getViews(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');
        if (!$path) {
            $path = '';
        }
        $arrPath = ['templates' => resource_path('views/templates' . $path)];

        $res = [];
        $files = scandir($arrPath[$disk], 0);
        foreach ($files as $v) {
            if ($v != '.' && $v != '..') {
                $res[] = [
                    'name' => $v,
                    'path' => $arrPath[$disk] . DIRECTORY_SEPARATOR . $v,
                    'size' => filesize($arrPath[$disk] . DIRECTORY_SEPARATOR . $v),
                    'type' => File::mimeType($arrPath[$disk] . DIRECTORY_SEPARATOR . $v),
                ];
            }

        }

        return ['list' => $res, 'fullPath' => $disk == 'templates' ? resource_path('views/templates' . $path) : public_path('static' . $path), 'path' => $path];
    }

    /**
     * make dir
     *
     * @param Request $request
     * @return array
     */
    public function makeDirectory(Request $request): array
    {
        $path = $request->input('path');

        if (!File::exists($path)) {
            mkdir($path, 0777, true);
            return ['code' => '200', 'message' => 'ok'];
        }
        return ['code' => '201', 'message' => '目录已经存在'];
    }

    /**
     * make file
     *
     * @param Request $request
     * @return array
     */
    public function makeFile(Request $request): array
    {
        $path = $request->input('path');
        if (touch($path)) {
            return ['code' => '200', 'message' => 'ok'];
        } else {
            return ['code' => '201', 'message' => '创建失败，联系管理员'];
        }
    }

}
