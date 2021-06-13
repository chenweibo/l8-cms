<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\User;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        $list = User::where("isAdmin", '!=', 1)->get();

        return Inertia::render('Account/List', ['list' => $list]);
    }

    public function create(Request $request): \Inertia\Response
    {

        return Inertia::render('Account/AccountForm', ['isEdit' => false]);

    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        Validator::make($request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required'],
            ],
            [
                'name.required' => '名称不能为空',
                'email.required' => '邮箱不能为空',
                'email.email' => '邮箱格式不正确',
                'email.unique' => '邮箱已经被使用',
                'password.required' => '密码不能为空',
            ]
        )->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('accounts.index');
    }

    public function update(Request $request, User $user)
    {
        Validator::make($request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'password' => ['required'],
            ],
            [
                'name.required' => '名称不能为空',
                'email.required' => '邮箱不能为空',
                'email.email' => '邮箱格式不正确',
                'email.unique' => '邮箱已经被使用',
                'password.required' => '密码不能为空',
            ]
        )->validate();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return Redirect::route('accounts.index');

    }


    /**
     *
     *
     * @param User $user
     * @return \Inertia\Response
     * @throws \Exception
     */
    public function edit(User $user)
    {
        return Inertia::render('Account/AccountForm', ['isEdit' => true, 'account' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->tokens->each->delete();
        $user->delete();
        return Redirect::route('accounts.index');
    }



    public function adminLogout(): RedirectResponse
    {
        Auth::logout();
        return Redirect::route('login');
    }

}
