<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SurveyRequest;
use App\Models\Admin\Fclient;
use App\Models\Front\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SurveyController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:survey', ['only' => ['index', 'chart']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::orderBy('id', 'asc')->get();
        return view('admin.statistics.survey', compact('surveys'));
    }


    public function chart()
    {

        $survey = Survey::all()->groupBy(function ($item) {

            return $item->user_id;
        });


        // foreach ($ads as $key => $ad) {
        //     $day = $key;
        //     $totalCount = $ad->sum('statistics');
        // }

        return view('admin.statistics.surveyChart', compact('survey'));
    }

    // public function index(Fclient $client, User $user)
    // {
    //     return view('admin.Clients.survay', compact('client' , 'user'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client, $user)
    {
        $client = Fclient::where('slug', $client)->first();
        $user = User::where('slug', $user)->first();

        return view('admin.Clients.survay', compact('client', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyRequest $request, Fclient $client, User $user)
    {
        $survey = Survey::where('client_id', $client->id)->where('user_id', $user->id)->first();

        if ($survey == null) {
            $inputs = $request->all();
            $inputs['value'] = $inputs['star'];
            $inputs['user_id'] = $user->id;
            $inputs['client_id'] = $client->id;

            Survey::create($inputs);
            return back()->with('swal-success', 'نظر شما با موفقیت ثبت شد');
        } else {
            return back()->with('swal-error', 'شما قبلا به این مشاور رای داده اید');
        }
    }

    public function show(Survey $survey)
    {
        return view('admin.statistics.show', compact('survey'));
    }
}
