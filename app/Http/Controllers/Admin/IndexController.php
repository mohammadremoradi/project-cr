<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Fclient;
use Illuminate\Http\Request;

use Stevebauman\Location\Facades\Location;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $api = $request->ip();

        $ip = '82.180.174.96'; /* Static IP address */

        $currentUserInfo = Location::get($ip);

        // dd($currentUserInfo);

        $todayClients = Fclient::whereDate('created_at', today())->count();

        $registerClients = Fclient::whereDate('updated_at', today())->where('status', 'done')->count();
        $deleteClients = Fclient::whereDate('updated_at', today())->whereNotNull('response')->count();

        $totalClients = Fclient::all()->last()->id;
        $totalTime = Fclient::sum('hours');
        $clientAge = Fclient::avg('age');

        $instagram = Fclient::where('about_us', 'instagram')->count();
        $google = Fclient::where('about_us', 'google')->count();
        $friend = Fclient::where('about_us', 'friend')->count();
        $linkedin = Fclient::where('about_us', 'linkedin')->count();
        $telegram = Fclient::where('about_us', 'telegram')->count();

        return view('admin.index', compact('clientAge', 'telegram', 'friend', 'linkedin', 'google', 'instagram', 'todayClients', 'registerClients', 'deleteClients', 'totalClients', 'totalTime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
