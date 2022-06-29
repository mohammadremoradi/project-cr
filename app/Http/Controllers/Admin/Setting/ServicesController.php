<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ServiceRequest;
use App\Models\Admin\Setting\Course;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:setting-service-client', ['only' => [
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
        $services = Course::all();

        return view('admin.Setting.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Setting.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $inputs = $request->all();
        Course::create($inputs);
        return to_route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $service)
    {
        return view('admin.Setting.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Course $service)
    {
        $service->update($request->all());
        return to_route('services.index');
    }
}
