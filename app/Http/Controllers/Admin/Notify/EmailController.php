<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notify\EmailRequest;
use App\Models\Admin\Fclient;
use App\Models\Admin\Notify\Email;
use App\Models\Admin\Setting\Tag;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:notify-email', ['only' => [
            'index', 'store',
            'create', 'edit', 'update', 'show',
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
        $emails = Email::all();
        return view('admin.Notify.email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.Notify.email.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        Email::create($inputs);
        return to_route('email.index')->with('success', "Record Created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        $id = $email->tag_id;
        $clients = Fclient::where('tag_id',$id)->get();
        return view('admin.Notify.email.show', compact(['email' ,'clients'] ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        $tags = Tag::all();
        return view('admin.Notify.email.edit', compact(['email', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $email->update($inputs);
        return to_route('email.index')->with('success', "Record Edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return to_route('email.index')->with('success', "Record Deleted Successfully");
    }

    // public function status(Email $email)
    // {
    //     $email->status = $email->status == "inactive" ? "active" : "inactive";
    //     $result = $email->save();

    //     if ($result) {
    //         if ($email->status == "inactive")
    //         {
    //             return response()->json(['status' => true, 'active' => false]);
    //         } else {
    //             return response()->json(['status' => true, 'active' => true]);
    //         }
    //     } else {
    //         return response()->json(['status' => false]);
    //     }
    // }

}
