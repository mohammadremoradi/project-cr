<?php

namespace App\Http\Controllers\Admin\Accounting\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accounting\Advertising\SourseRequest;
use App\Models\Admin\Accounting\Advertising\Advertise;
use App\Models\Admin\Accounting\Advertising\Sourse;
use Illuminate\Http\Request;

class SourseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:accounting-advertise-sourse', ['only' => [
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
        $sourses = Sourse::orderBy('id', 'asc')->get();
        return view('admin.Accounting.advertise.sourse.index', compact('sourses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Accounting.advertise.sourse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SourseRequest $request)
    {
        $inputs = $request->all();

        Sourse::create($inputs);

        return to_route('sourse.index')->with('success', "sourse has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Sourse $sourse)
    {
        $ads = Advertise::where('sourse_id', $sourse->id)->orderBy('published_at')->get()->groupBy(function ($item) {

            return $item->published_at->format('Y-m-d');
        });

        foreach ($ads as $key => $ad) {
            $day = $key;
            $totalCount = $ad->sum('statistics');
        }


        return view('admin.Accounting.advertise.sourse.show', compact('ads'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sourse $sourse)
    {
        return view('admin.Accounting.advertise.sourse.edit', compact('sourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SourseRequest $request, Sourse $sourse)
    {
        $inputs = $request->all();
        $sourse->update($inputs);
        return to_route('sourse.index')->with('success', "sourse has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sourse $sourse)
    {
        $sourse->delete();
        return to_route('sourse.index')->with('success', "sourse has been deleted");
    }
}
