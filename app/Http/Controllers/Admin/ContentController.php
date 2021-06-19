<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Component;
use App\Models\Content;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        if ($menu->type == 2) {
            $content = $menu->article;
            $frameName = 'PageFrame';
            $component = Component::where('scope', 2)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

            return Inertia::render('Contents/List', ['menu' => $nodes, 'component' => $component, 'isIndex' => false, 'menuId' => $menuId, 'content' => $content, 'frameName' => $frameName, 'title' => $menu->name]);
        }
        if ($menu->type == 3) {
            $keys = $request->keys;
            $frameName = 'ListFrame';
            $content = Content::Select('id', 'name', 'status','sort')->where('category_id', $menu->id)
                ->when($keys, function ($query, $keys) {
                    return $query->where('name', 'like', '%'.$keys.'%');
                })
                ->orderBy('sort', 'asc')->paginate(10)->withQueryString();
            //dd($content);
            return Inertia::render('Contents/List', ['menu' => $nodes, 'component' => [], 'isIndex' => false, 'menuId' => $menuId, 'content' => $content, 'frameName' => $frameName, 'title' => $menu->name]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
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
        $content->detail = $request->detail;
        $content->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Content $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }
}
