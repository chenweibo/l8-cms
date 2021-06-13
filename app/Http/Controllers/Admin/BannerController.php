<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\Component;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Banners/Show', ['list' => Banner::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create()
    {

        $component = Component::where('scope', 4)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

        return Inertia::render('Banners/BannerDetail', ['isEdit' => false, 'component' => $component]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),
            ['name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255']
            ],
            ['name.required' => '名称不能为空',
                'description.required' => '描述不能为空',
            ]
        )->validate();
        Banner::create([
            'name' => $request->name,
            'description' => $request->description,
            'banners' => $request->banners,
        ]);
        return Redirect::route('banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Banner $banner
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function edit(Banner $banner)
    {

        $component = Component::where('scope', 4)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

        return Inertia::render('Banners/BannerDetail', ['isEdit' => true, 'banners' => $banner,'component' => $component]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Banner $banner
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $banner->forceFill($request->all())->save();
        return Redirect::route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Banner $banner
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return Redirect::route('banners.index');
    }
}
