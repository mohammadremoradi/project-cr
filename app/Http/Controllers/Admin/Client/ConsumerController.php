<?php

namespace App\Http\Controllers\admin\client;

use App\Enums\FileType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\ClientRequest;
use App\Http\Requests\Admin\Client\ConsumerRequest;
use App\Http\Services\File\FileService;
use App\Models\Admin\Fclient;
use App\Models\Admin\Setting\ConsumerStatus;
use App\Models\Admin\Setting\Course;
use App\Models\Admin\Setting\Tag;
use App\Models\Front\Consumer\Consumer;
use App\Models\Front\Consumer\ConsumerFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

use Illuminate\Support\Facades\Storage;

class ConsumerController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:consumer', ['only' => [
            'index', 'store',
            'create', 'edit', 'update', 'show', 'waiting' , 'registerView' , 'register',
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
        $clients = Fclient::where('status', 'done')->whereNot('waiting', 0)->orderBy('updated_at', 'asc')->get();
        return view('admin.Clients.consumer.index', compact('clients'));
    }


    public function waiting()
    {
        $clients = Fclient::where('status', 'done')->where('waiting', 0)->orderBy('updated_at', 'asc')->get();
        return view('admin.Clients.consumer.index', compact('clients'));
    }

    public function registerView(Fclient $client)
    {

        $statuses = ConsumerStatus::all();
        $users = User::where('is_admin', '1')->get();
        return view('admin.Clients.consumer.register', compact('client', 'users', 'statuses'));
    }


    public function register(ConsumerRequest $request, Fclient $client)
    {
        $inputs = $request->all();
        $inputs['phone'] = convertNum($request->phone);
        if (preg_match('/^(\+98|98|9)\d{9}$/', $inputs['phone']) or preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['phone'])) {
            $inputs['phone'] = substr($inputs['phone'], 0, 2) === '98' ? substr($inputs['phone'], 2) : $inputs['phone'];
            $inputs['phone'] = str_replace("+98", "", $inputs['phone']);
            $inputs['phone'] = strlen($inputs['phone']) === 10 ? "0" . $inputs['phone'] : $inputs['phone'];
            $inputs['activation'] = 1;
            $inputs['client_id'] = $client->id;
            $inputs['hours'] = null;

            DB::transaction(function () use ($inputs, $client) {

                $client->update(['waiting' => "1"]);
                User::create($inputs);
                Consumer::create($inputs);
            });

            return to_route('consumer.index')->with('success', 'client has been registered');
        } else {
            return to_route('consumer.index')->with('swal-error-phone', 'Wrong number format');
        }

        $users = User::where('is_admin', '1')->get();

        return view('admin.Clients.consumer.register', compact('client', 'users'));
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
    public function edit(Fclient $client)
    {
        $users = User::where('is_admin', '1')->get();
        $courses = Course::all();
        $tags = Tag::all();
        $statuses = ConsumerStatus::all();
        return view('admin.Clients.consumer.edit', compact('client', 'users', 'courses', 'tags' , 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */







    public function update(ClientRequest $request, Fclient $client)
    {
        $inputs = $request->all();
        $client->update($inputs);
        $client->consumer->update($inputs);

        return to_route('consumer.index')->with('success' , 'consumer has been updated');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
