<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Overtrue\LaravelUploader\StrategyResolver;
use Storage;

class UploadsController extends Controller
{
    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = StrategyResolver::resolveFromRequest($request, 'default')->upload();

        return response()->json($response);
    }

    public function download(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Storage::disk('local')->download($request->pathToFile);
    }
}
