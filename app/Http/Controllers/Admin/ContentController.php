<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Component;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Validator;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $nodes = Category::where('url', '!=', '/')->orderBy('sort', 'asc')->get()->toTree();

        return Inertia::render('Contents/List', ['menu' => $nodes, 'isIndex' => true]);
    }

    public function handleContent(Request $request, $menuId): \Inertia\Response
    {
        $nodes = Category::where('url', '!=', '/')->orderBy('sort', 'asc')->get()->toTree();
        $menu = Category::find($menuId);
        if (! $menu) {
            abort(404);
        }

        if ($menu->type == 1) {
            $content = $menu->article;
            $frameName = 'PageFrame';
            $component = Component::where('scope', 2)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

            return Inertia::render('Contents/List', ['menu' => $nodes, 'component' => $component, 'isIndex' => false, 'menuId' => $menuId, 'content' => $content, 'frameName' => $frameName, 'title' => $menu->name]);
        }
        if ($menu->type == 2) {
            $keys = $request->keys;
            $frameName = 'ListFrame';
            $content = Content::Select('id', 'name', 'status', 'sort', 'redirect', 'detail')->where('category_id', $menu->id)
                ->when($keys, function ($query, $keys) {
                    return $query->where('name', 'like', '%'.$keys.'%');
                })
                ->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

            return Inertia::render('Contents/List', ['menu' => $nodes, 'component' => [], 'keys' => $request->keys, 'isIndex' => false, 'menuId' => $menuId, 'content' => $content, 'frameName' => $frameName, 'title' => $menu->name]);
        }

        return Inertia::render('Contents/List', ['menu' => $nodes, 'isIndex' => false, 'menuId' => $menuId, 'frameName' => 'MsgFrame', 'title' => $menu->name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        $nodes = Category::where('url', '!=', '/')->orderBy('sort', 'asc')->get()->toTree();
        $menu = Category::find($request->menuId);
        if (! $menu) {
            abort(404);
        }

        $component = Component::where('scope', 3)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

        return Inertia::render('Contents/ListForm', ['menu' => $nodes, 'component' => $component, 'menuId' => $menu->id, 'title' => $menu->name, 'isEdit' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'category_id' => ['required'],
            ],
            [
                'name.required' => '名称不能为空',
                'category_id.required' => '类目不能为空',
            ]
        )->validate();

        Content::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Content $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Content $content
     * @return \Inertia\Response
     */
    public function edit(Content $content, Request $request)
    {
        $nodes = Category::where('url', '!=', '/')->orderBy('sort', 'asc')->get()->toTree();
        $menu = Category::find($request->menuId);
        if (! $menu) {
            abort(404);
        }
        $component = Component::where('scope', 3)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

        return Inertia::render('Contents/ListForm', ['menu' => $nodes, 'component' => $component, 'content' => $content, 'menuId' => $menu->id, 'title' => $menu->name, 'isEdit' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Content $content
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $content->name = $request->name;
        $content->sort = $request->sort;
        $content->views = $request->views;
        $content->redirect = $request->redirect;
        $content->detail = $request->detail;
        $content->save();

        return Redirect::route('contents.handleContent', $request->menuId);
    }

    /**
     * update content redirect.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse|\Inertia\Response
     */
    public function updateRedirect(Request $request, Content $content)
    {
        $content->redirect = $request->redirect;
        $content->save();

        return back();
    }

    /**
     * update content status.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function updateStatus(Request $request, Content $content): RedirectResponse
    {
        // dd($request->status);
        $content->status = $request->status;
        $content->save();

        return back();
    }

    /**
     * update content sort.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse|\Inertia\Response
     */
    public function updateSort(Request $request, Content $content)
    {
        $content->sort = $request->sort;
        $content->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Content $content
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Content $content)
    {
        $content->delete();

        return back();
    }

    public function moreDelete(Request $request): RedirectResponse
    {
        Content::destroy(collect($request->ids));

        return back();
    }

    public function moveContent(Request $request)
    {
        $content = Content::find($request->ids);
        foreach ($content as $notice) {
            $notice->category_id = $request->moveId;
            $notice->save();
        }

        return back();
    }

    public function copyContent(Request $request)
    {
        $now = Carbon::now();
        $content = Content::select('name', 'redirect', 'status', 'views', 'sort', 'detail', 'page_id', 'category_id', 'created_at', 'updated_at')->find($request->ids);
        foreach ($content as $notice) {
            $notice->category_id = $request->moveId;
            $notice->created_at = $now;
            $notice->updated_at = $now;
        }
        Content::insert($content->toArray());

        return back();
    }
}
