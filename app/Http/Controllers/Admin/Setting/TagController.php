<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\TagRequest;
use App\Models\Admin\Fclient;
use App\Models\Admin\Setting\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:setting-tag-client', ['only' => [
            'index', 'store',
            'create', 'edit', 'update',
            'destroy'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $tags = Tag::all();
        return view('admin.Setting.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Setting.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $inputs = $request->all();
        Tag::create($inputs);

        return to_route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $clients = Fclient::where("tag_id", $tag->id)->get();
        return view('admin.Setting.tag.show', compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.Setting.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $inputs = $request->all();
        $tag->update($inputs);
        return to_route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeTagClient(Fclient $client)
    {

        $inputs['tag_id'] = null;
        $client->update($inputs);

        return redirect()->back()->with('success', "tag client has been deleted");
    }
}
