<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ConsumerStatusRequest;
use App\Models\Admin\Setting\ConsumerStatus;
use Illuminate\Http\Request;

class ConsumerStatusController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:setting-status-client', ['only' => [
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
        $statuses = ConsumerStatus::all();
        return view('admin.Setting.status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Setting.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerStatusRequest $request)
    {
        ConsumerStatus::create($request->all());
        return to_route('status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsumerStatus $status)
    {
        return view('admin.Setting.status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerStatusRequest $request, ConsumerStatus $status)
    {
        $status->update($request->all());
        return to_route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
