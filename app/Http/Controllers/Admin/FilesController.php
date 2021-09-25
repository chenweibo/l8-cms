<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PhpZip\Exception\ZipException;
use PhpZip\ZipFile;

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
     * get views list.
     *
     * @return array
     */
    public function getViews(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');

        if (! $path) {
            $path = '';
        }
        $files = Storage::disk($disk)->files($path);
        $dir = Storage::disk($disk)->directories($path);

        return ['dir' => handleLastPath($dir), 'files' => handleLastPath($files), 'disk' => $disk, 'path' => $path];
    }

    public function getDiskList(Request $request)
    {
        $disk = $request->input('disk');
    }

    /**
     * make dir.
     *
     * @param Request $request
     * @return array
     */
    public function makeDirectory(Request $request): array
    {
        $disk = $request->input('disk');
        $path = $request->input('path');
        $name = $request->input('name');

        if (! $path) {
            $path = '';
        }

        if (! Storage::disk($disk)->exists($path.DIRECTORY_SEPARATOR.$name)) {
            mkdir(Storage::disk($disk)->path($path.DIRECTORY_SEPARATOR.$name), 0777, true);

            return ['code' => 200, 'message' => 'ok'];
        }

        return ['code' => 201, 'message' => '目录已经存在'];
    }

    /**
     * make file.
     *
     * @param Request $request
     * @return array
     */
    public function makeFile(Request $request): array
    {
        $disk = $request->input('disk');
        $path = $request->input('path');
        $name = $request->input('name');

        if (! $path) {
            $path = '';
        }

        if (! Storage::disk($disk)->exists($path.DIRECTORY_SEPARATOR.$name)) {
            touch(Storage::disk($disk)->path($path.DIRECTORY_SEPARATOR.$name));

            return ['code' => 200, 'message' => 'ok'];
        }

        return ['code' => 201, 'message' => '文件已经存在'];
    }

    /**
     * make file.
     *
     * @param Request $request
     * @return array
     */
    public function getFileContent(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');

        if (! $path) {
            $path = '';
        }
        $size = Storage::disk($disk)->size($path);
        if ($size > 1048576 * 2) {
            return ['code' => 201, 'message' => '文件超过2mb，不允许预览.'];
        } else {
            return ['code' => 200, 'message' => 'ok', 'data' => Storage::disk($disk)->get($path)];
        }
    }

    /**
     * make file.
     *
     * @param Request $request
     * @return array
     */
    public function getUpdateFileContent(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');

        if (! $path) {
            $path = '';
        }

        $size = Storage::disk($disk)->size($path);
        if ($size > 1048576 * 2) {
            return ['code' => 201, 'message' => '文件超过2mb，不允许预览.'];
        } else {
            return ['code' => 200, 'message' => 'ok', 'data' => Storage::disk($disk)->put($path, $request->input('content'))];
        }
    }

    public function deleteFile(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');

        if (! $path) {
            $path = '';
        }

        if ($request->type == 'dir') {
            Storage::disk($disk)->deleteDirectory($path);
        } else {
            Storage::disk($disk)->delete($path);
        }

        return ['code' => '200', 'message' => 'ok'];
    }

    public function rename(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');
        $newName = $request->input('newName');

        //rename(Storage::disk($disk)->path($path), Storage::disk($disk)->path($path.DIRECTORY_SEPARATOR.$newName));

        return ['code' => '200', 'message' => 'ok'];
    }

    public function download(Request $request, $disk, $path)
    {
        return Storage::disk($disk)->download($path);
    }

    public function unzip(Request $request)
    {
        $disk = $request->input('disk');
        $path = $request->input('path');
        $newName = $request->input('newName');

        $zipFile = new ZipFile();

        try {
            $zipFile
                ->openFile(Storage::disk($disk)->path($path.DIRECTORY_SEPARATOR.$newName)) // open archive from file
                ->extractTo(Storage::disk($disk)->path($path)); // extract files to the specified directory

            return ['code' => 200, 'message' => 'ok'];
        } catch (ZipException $e) {
            return ['code' => 201, 'message' => $e->getMessage()];
        } finally {
            $zipFile->close();
        }
    }
}
