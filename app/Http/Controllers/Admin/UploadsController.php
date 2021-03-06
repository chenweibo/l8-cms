<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Overtrue\LaravelUploader\StrategyResolver;

class UploadsController extends Controller
{
    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = StrategyResolver::resolveFromRequest($request, 'default')->upload();

        return response()->json($response);
    }

    public function download(Request $request): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return Storage::disk('local')->download($request->pathToFile);
    }

    public function uploadManage(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');
        $file = $request->file('file');

        if (! $path) {
            $path = '';
        }
        Storage::disk($disk)->putFileAs(
            $path,
            $file,
            $file->getClientOriginalName()
        );

        return ['code'=>200];
    }

    public function uploadFiles(Request $request)
    {
        $file = $request->file('file');

        $name = Str::random(40).'.'.$file->getClientOriginalExtension();
        $path = Storage::disk('public')->putFileAs(
            'uploads/file',
            $file,
            $name
        );

        return ['path'=>$path, 'file'=>$file->getClientOriginalName()];
    }
}
