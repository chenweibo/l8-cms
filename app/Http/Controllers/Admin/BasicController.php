<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use Redirect;

class BasicController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function show()
    {
        $basic = Config::where('type', 'basic')->get();
        $component = Component::where('scope', 0)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get()->toArray();

        if ($basic->isEmpty()) {
            return Inertia::render('Basic/Show', ['basic' => $component, 'component' => $component]);
        }

        return Inertia::render('Basic/Show', ['basic' => $basic[0]->options, 'component' => $component]);
    }

    public function initializationBasic(): array
    {
        $logo = ['value' => '', 'note' => [], 'label' => 'logo', 'column' => 'logo'];

        return ['title' => '', 'logo' => $logo, 'keywords' => '', 'description' => '', 'address' => '', 'email' => '', 'www' => '', 'telephone' => '', 'icp' => '', 'custom' => '', 'custom2' => '', 'custom3' => ''];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function update(Request $request)
    {
        Config::updateOrCreate(
            ['type' => 'basic', 'title' => '基本设置', 'description' => '站点基本设置'],
            ['options' => $request->options]
        );
        //dd($request->options);

        return Redirect::route('basic.show');
    }
}
