<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notify\SmsRequest;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Admin\Fclient;
use App\Models\Admin\Notify\Sms;
use App\Models\Admin\Setting\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Morilog\Jalali\Jalalian;

class SmsController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:notify-sms', ['only' => [
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
        $sms = Sms::all();

        return view('admin.Notify.sms.index', compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.Notify.sms.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(SmsRequest $request)
    {
        $inputs = $request->all();

        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        Sms::create($inputs);


        $numbers = Fclient::where('tag_id', $request->tag_id)->select('phone')->get();

        foreach ($numbers as $num) {
            $m[] = $num->phone;
        }

        // dd($m);
        $smsService = new SmsService();

        $smsService->setFrom(Config::get('sms.otp_from'));
        $smsService->setTo($m);
        $smsService->setText($request->subject . $request->body);
        $smsService->setIsFlash(true);


        $messageService = new MessageService($smsService);

        $messageService->send();

        return to_route('sms.index')->with('success' . "Record Created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sms $sms)
    {
        return view('admin.Notify.sms.show', compact('sms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sms $sms)
    {
        return view('admin.Notify.sms.edit', compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SmsRequest $request, Sms $sms)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        $sms->update($inputs);
        return to_route('sms.index')->with('success' . "Record Edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sms $sms)
    {
        $sms->delete();
        return to_route('sms.index')->with('success' . "Record Deleted Successfully");
    }
}
