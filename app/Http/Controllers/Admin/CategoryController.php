<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index()
    {

        $nodes = Category::orderBy('sort', 'asc')->get()->toTree();

        return Inertia::render('Categories/Index', ['categoryList' => $nodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create(Request $request)
    {
        $org_tree = Category::orderBy('sort', 'asc')->get()->toTree();
//        $remove_empty_children = function ($elemente) use (&$remove_empty_children) {
//            foreach ($elemente as $element) {
//                if ($element->children->isNotEmpty()) {
//                    $remove_empty_children($element->children);
//                } else {
//                    $element->unsetRelation('children');
//                }
//            }
//        };
//
//        $remove_empty_children($org_tree);
        $component = Component::where('scope', 1)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

        return Inertia::render('Categories/CategoryForm', ['isEdit' => false, 'viewList' => scandir(resource_path('views/templates'), 0), 'parent_id' => $request->parent_id, 'params' => $request->all(), 'categoryList' => $org_tree, 'component' => $component]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {

        Validator::make($request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'url' => ['required', in_array($request->input("type"), ['0', '1', '6']) ? 'unique:categories,url' : ''],
                'controller' => [in_array($request->input("type"), ['6']) ? 'required' : ''],
                'function' => [in_array($request->input("type"), ['6']) ? 'required' : ''],
                'parent_id' => ['required']
            ],
            [
                'name.required' => '名称不能为空',
                'url.unique' => '已经存在同样的url',
                'parent_id.required' => '类目不能为空',
            ]
        )->validate();

        $all = $request->all();
        $handle = $this->handleConversion($request);
        $all['controller'] = $handle[0];
        $all['function'] = $handle[1];

        if ($request->parent_id == 0) {


            Category::create($all);
        } else {
            Category::create($all, Category::find($request->parent_id));
        }

        return Redirect::route('categories.index');

    }

    public function handleConversion($request)
    {
        if (trim($request->url) == '/') {
            return ['BusinessController', 'index'];
        } else {

            switch ($request->type) {
                case $request->type == '0':
                    return ['BusinessController', 'page'];
                case $request->type == '1':
                    return ['BusinessController', 'page'];
                case $request->type == '2':
                    return ['BusinessController', 'list'];
                case $request->type == '3':
                    return [$request->controller, $request->function];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response|\Inertia\Response
     */
    public function edit(Category $category)
    {
        $org_tree = Category::orderBy('sort', 'asc')->get()->toTree();

        $component = Component::where('scope', 1)->select('id', 'label', 'column', 'note', 'value', 'type', 'scope')->get();

        return Inertia::render('Categories/CategoryForm', ['isEdit' => true, 'component' => $component, 'categoryList' => $org_tree, 'category' => $category, 'viewList' => scandir(resource_path('views/templates'))]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->type == '2') {
            Validator::make($request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'parent_id' => ['required']
                ],
                [
                    'name.required' => '名称不能为空',
                    'parent_id.required' => '类目不能为空',
                ]
            )->validate();
        } else {
            Validator::make($request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'url' => ['required',
                        Rule::unique('categories')->ignore($category->id)
                    ],
                    'parent_id' => ['required']
                ],
                [
                    'name.required' => '名称不能为空',
                    'url.unique' => '已经存在同样的url',
                    'parent_id.required' => '类目不能为空',
                ]
            )->validate();
        }


        $category->update($request->except('parent_id'));
        if ($request->input('parent_id') == 0) {
            $category->makeRoot()->save();
        } else {
            $parent = Category::find($request->input('parent_id'));
            $category->parent_id = $parent->id;
            $category->save();

        }
        return Redirect::route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('categories.index');
    }


    /**
     * update menu sort.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse|\Inertia\Response
     */
    public function updateSort(Request $request, Category $category)
    {

        $category->sort = $request->sort;
        $category->save();
        return Redirect::route('categories.index');

    }


    /**
     * update menu redirect.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse|\Inertia\Response
     */
    public function updateRedirect(Request $request, Category $category)
    {

        $category->redirect = $request->redirect;
        $category->save();
        return Redirect::route('categories.index');
    }


    /**
     * update menu status.
     *
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Category $category): \Illuminate\Http\JsonResponse
    {

        $category->status = $request->status;
        $category->save();
        return response()->json(['code' => 200, 'status' => $category->status]);
    }

    public function generateMenu(): array
    {

        $list = Category::all();
        $content = '';

        $start = '<?php' . PHP_EOL;
        $content .= $start . PHP_EOL
            . 'use Illuminate\Support\Facades\Route;' . PHP_EOL
            . 'use App\Http\Controllers\Home\BusinessController;' . PHP_EOL
            . 'use App\Http\Controllers\Home\CustomController;' . PHP_EOL . PHP_EOL;

        $handle = $this->handleRouteArr($content);
        File::replace(base_path('routes/template.php'), $handle);
        return ['code' => 200, 'mes' => 'ok'];

    }

    public function handleRouteArr($content)
    {
        $list = Category::get();
        $uni = second_array_unique_bykey($list, 'url');

        foreach ($uni as $v) {

            switch ($v->type) {
                case $v->type == '0':

                    $content .= "Route::get('" . $v->url . "', [ " . $v->controller . "::class, 'page']);" . PHP_EOL;
                    break;
                case $v->type == '1':
                    $content .= "Route::get('" . $v->url . "', [ " . $v->controller . "::class, 'page']);" . PHP_EOL;
                    break;
                case $v->type == '2':
                    $content .= "Route::get('" . $v->url . "/{id?}', [ " . $v->controller . "::class, 'list']);" . PHP_EOL;
                    $content .= "Route::get('" . $v->url . "View/{id?}', [ " . $v->controller . "::class, 'listView']);" . PHP_EOL;
                    break;
                case $v->type == '3':
                    $content .= "Route::get('" . $v->url . "', [ " . $v->controller . "::class, '" . $v->function . "']);" . PHP_EOL;
                    break;
            }

        }

        return $content;
    }
}
