<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        $list = Message::latest()->paginate(10);

        return Inertia::render('Message/List', ['list' => $list]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function show(Message $message)
    {
        $message->is_read = 1;
        $message->save();

        return Inertia::render('Message/MessageRead', ['content' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return Redirect::route('messages.index');
    }

    public function allRead(): \Illuminate\Http\RedirectResponse
    {
        DB::update('update messages set is_read=1 where is_read = 0');

        return Redirect::route('messages.index');
    }

    public function allDelete(): \Illuminate\Http\RedirectResponse
    {
        //一键清空批量删除
        Message::where('id', '>', 0)->delete();

        return Redirect::route('messages.index');
    }
}
