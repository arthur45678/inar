<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends AdminController
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Show all messages
     */
    public function index()
    {
        $posts = Notification::orderBy('id','desc')->paginate(20);
        return view('admin.notifications.index')->with([
            'title' => 'Բոլոր ծանուցումները',
            'posts' => $posts,
        ]);
    }

    public function sendNotification()
    {
        $receivers = User::where(['type' => User::TYPE_INVESTOR])->get();
        return view('admin.notifications.sendNotification')->with([
            'title' => 'Ավելացնել',
            'receivers' => $receivers,
        ]);
    }

    public function storeNotifications(Request $request)
    {
        $input = $request->all();
        Notification::storeMessages($input);

        return redirect()->route('admin.notifications.index')->with(['success' => 'Ծանուցումը ուղարկվեց']);
    }

    public function viewSingleMessage($id)
    {
        $post = Notification::find($id);
        return view('admin.notifications.viewSingleMessage')->with([
            'title' => 'Տեսնել',
            'post' => $post,
        ]);
    }


}
