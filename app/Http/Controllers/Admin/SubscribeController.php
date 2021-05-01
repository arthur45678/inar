<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Settings;
use App\Models\Subscribe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SubscribeController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:posts-list');
        $this->middleware('permission:posts-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:posts-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        parent::__construct();
    }


    public function index(Request $request)
    {
        $posts = Subscribe::paginate(20);


        /*return view('admin.subscribe.index', compact('subscribe'));*/
        return view('admin.subscribe.index')->with([
            'posts' => $posts,
        ]);
    }

    public function edit($id)
    {
        $item = Subscribe::findOrFail($id);
        return view('admin.subscribe.edit')->with([
            'title' => 'Փոփոխել հոդվածը',
            'item' => $item,
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $input = $request->all();
        $item = Subscribe::findOrFail($id);
        $item->update($input);
        return redirect()->route('admin.subscribe.index')->with(['success' => 'Թարմացվել է']);

    }


    public function storeSubscribeModalTextSettings(Request $request)
    {
        $data = $request->all();

        Settings::storeMultilanguageSettings($data);
        return redirect()->back();
    }


    public function destroy($id)
    {
        Subscribe::findOrFail($id)->delete();
        return redirect()->route('admin.subscribe.index')
            ->with('success', 'Ջնջվեց');
    }


}
