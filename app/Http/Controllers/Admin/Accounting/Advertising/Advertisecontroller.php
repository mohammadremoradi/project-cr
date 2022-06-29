<?php

namespace App\Http\Controllers\Admin\Accounting\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accounting\Advertising\AdvertiseRequest;
use App\Http\Services\File\FileService;
use App\Models\Admin\Accounting\Advertising\Advertise;
use App\Models\Admin\Accounting\Advertising\Budget;
use App\Models\Admin\Accounting\Advertising\Sourse;
use App\Models\User;
use Illuminate\Http\Request;

class Advertisecontroller extends Controller
{
    function __construct()
    {
        $this->middleware('permission:accounting-advertise', ['only' => [
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
        $advetises = Advertise::orderBy('id', 'asc')->get();
        $cost = Advertise::sum('price');
        $budget = Budget::sum('price');
        $total = $budget - $cost . ".000";
        return view('admin.Accounting.advertise.advertise.index', compact('advetises', 'budget', 'cost' , 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sourses = Sourse::all();
        $users = User::all();
        return view('admin.Accounting.advertise.advertise.create', compact('sourses', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertiseRequest $request, FileService $fileService)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        if ($request->hasFile('file')) {
            $fileService->setExclusiveDirectory('Uploads' . DIRECTORY_SEPARATOR . 'Advertise');
            $inputs['file_name'] = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileService->setFileName($inputs['file_name']);

            $result = $fileService->moveToPublic($request->file('file'));

            if ($result === false) {
                return redirect()->back()->with('swal-error', 'File has not been Uploaded');
            }

            $inputs['receipt'] = $result;
            $file = Advertise::create($inputs);
            // return to_route('advertise.index')->with('success', "ads has been created");
        } else {

            $file = Advertise::create($inputs);
        }

        return to_route('advertise.index')->with('success', "ads has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Advertise $advertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertise $advertise)
    {
        $sourses = Sourse::all();
        $users = User::all();
        return view('admin.Accounting.advertise.advertise.edit', compact('users', 'advertise', 'sourses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertiseRequest $request, Advertise $advertise, FileService $fileService)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        if ($request->hasFile('file')) {

            if (!empty($advertise->receipt)) {
                $fileService->deleteFile($advertise->file_path);
            }

            $fileService->setExclusiveDirectory('Uploads' . DIRECTORY_SEPARATOR . 'Advertise');

            $inputs['file_name'] = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileService->setFileName($inputs['file_name']);

            $result = $fileService->moveToPublic($request->file('file'));
            if ($result === false) {
                return redirect()->back()->with('swal-error', 'File has not been Uploaded');
            }
            $inputs['receipt'] = $result;
            $advertise->update($inputs);
        } else {

            $file = $advertise->update($inputs);
        }


        return to_route('advertise.index')->with('success', "ads has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertise $advertise)
    {
        $advertise->delete();
        return to_route('sourse.index')->with('success', "ads has been deleted");
    }


    public function download(Advertise $advertise)
    {
        $pathToFile = public_path($advertise->receipt);
        return response()->download($pathToFile);
    }
}
