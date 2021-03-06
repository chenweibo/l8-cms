<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BasicController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComponentController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DocController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ToolsController;
use App\Http\Controllers\Admin\UploadsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [BasicController::class, 'dashboard'])->name('dashboard');

\LaravelUploader::routes([
    'as' => 'files.upload',
    'middleware' => ['auth'],
    //...
]);

//后端路由
Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::post('/admin/upload', [UploadsController::class, 'upload'])->name('admin.upload');
        Route::get('/admin/download', [UploadsController::class, 'download'])->name('admin.download');

        Route::get('/basic/show', [BasicController::class, 'show'])->name('basic.show');
        Route::put('/basic/update', [BasicController::class, 'update'])->name('basic.update');
        Route::get('/admin/clearCache', [ToolsController::class, 'clearCache']);
        Route::get('/admin/cache', [ToolsController::class, 'cache']);

        Route::put('/updateSort/{category}', [CategoryController::class, 'updateSort'])->name('categories.updateSort');
        Route::put('/updateStatus/{category}', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
        Route::put('/updateRedirect/{category}', [CategoryController::class, 'updateRedirect'])->name('categories.updateRedirect');

        Route::put('content/updateSort/{content}', [ContentController::class, 'updateSort'])->name('contents.updateSort');
        Route::put('content/updateStatus/{content}', [ContentController::class, 'updateStatus'])->name('contents.updateStatus');
        Route::put('content/updateRedirect/{content}', [ContentController::class, 'updateRedirect'])->name('contents.updateRedirect');

        Route::post('/admin/categories/generate', [CategoryController::class, 'generateMenu'])->name('categories.generateMenu');
        Route::get('/admin/file', [FilesController::class, 'index'])->name('files.index');

        Route::get('/admin/file/templates', [FilesController::class, 'getViews'])->name('files.templates');

        Route::post('/admin/file/makeDir', [FilesController::class, 'makeDirectory'])->name('files.makeDirectory');
        Route::post('/admin/file/makeFile', [FilesController::class, 'makeFile'])->name('files.makeFile');

        Route::delete('/admin/file', [FilesController::class, 'deleteFile'])->name('files.delete');
        Route::put('/updateNote/{component}', [ComponentController::class, 'updateNote'])->name('components.updateNote');
        Route::get('/admin/filecontent', [FilesController::class, 'getFileContent'])->name('files.getcontent');

        Route::post('/admin/unzip', [FilesController::class, 'unzip'])->name('files.unzip');

        Route::put('/admin/filecontent', [FilesController::class, 'getUpdateFileContent'])->name('files.updatecontent');

        Route::post('/admin/filemanage/upload', [UploadsController::class, 'uploadManage'])->name('uploads.up');

        Route::post('/admin/fileupload', [UploadsController::class, 'uploadFiles'])->name('uploads.uploadFiles');

        Route::get('/admin/filemanage/down/{disk}/{path?}', [FilesController::class, 'download'])->name('uploads.download');

        Route::get('/admin/accounts/index', [AccountController::class, 'index'])->name('accounts.index');
        Route::get('/admin/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
        Route::get('/admin/accounts/{user}/edit', [AccountController::class, 'edit'])->name('accounts.edit');

        Route::post('/admin/accounts', [AccountController::class, 'store'])->name('accounts.store');
        Route::put('/admin/accounts/{user}', [AccountController::class, 'update'])->name('accounts.update');
        Route::delete('/admin/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');
        Route::post('/admin/adminLogout', [AccountController::class, 'adminLogout'])->name('logout.admin');
        Route::get('/admin/contents/{menuId}', [ContentController::class, 'handleContent'])->name('contents.handleContent');
        Route::post('/admin/contents/deleteMore', [ContentController::class, 'moreDelete'])->name('contents.moreDelete');
        Route::get('/admin/categories/flatTree', [CategoryController::class, 'categoryFlatTree'])->name('categories.flatTree');

        Route::get('/contents/move', [ContentController::class, 'moveContent'])->name('contents.move');
        Route::get('/contents/copy', [ContentController::class, 'copyContent'])->name('contents.copy');

        Route::get('/admin/message/allRead', [MessageController::class, 'allRead'])->name('messages.allRead');
        Route::get('/admin/message/allDelete', [MessageController::class, 'allDelete'])->name('messages.allDelete');

        Route::resources([
            'banners' => BannerController::class,
            'categories' => CategoryController::class,
            'contents' => ContentController::class,
            'components' => ComponentController::class,
        ]);
        Route::resource('messages', MessageController::class)->only([
            'index', 'show', 'destroy',
        ]);
        Route::get('/admin/doc/index', [DocController::class, 'index'])->name('doc.index');
    });
});
