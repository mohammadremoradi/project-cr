<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\ClientRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\Admin\Fclient;
use App\Models\Admin\Setting\Course;
use App\Models\Admin\Setting\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FclientController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:all-client-list', ['only' => ['index', 'outDateAllClient']]);
        $this->middleware('permission:all-my-client', ['only' => ['myClient', 'today', 'show', 'outDateMyClient']]);
        $this->middleware('permission:appointment-client', ['only' => ['appointmentView', 'appointment']]);
        $this->middleware('permission:client-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client-delete', ['only' => ['response']]);
        $this->middleware('permission:client-search', ['only' => ['search']]);
        $this->middleware('permission:show-client-delete', ['only' => ['deletes', 'destroy']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Fclient::whereNotNull('user_id')->whereNull('response')->orderBy('updated_at', 'asc')->get();

        return view('admin.Clients.index', compact('clients'));
    }


    public function myClient()
    {
        $my_name = Auth::user()->name;
        $clients = Fclient::whereNull('response')->where('status', '!=', 'done')->Where('cansultant_name', $my_name)->orderBy('updated_at')->get();
        return view('admin.Clients.index', compact('clients'));
    }


    public function outDateMyClient()
    {
        $my_name = Auth::user()->name;
        $clients = Fclient::whereNull('response')->where('status', '!=', 'done')->Where('cansultant_name', $my_name)->WhereDate('next_call', "<", today())->orderBy('created_at')->get();
        return view('admin.Clients.index', compact('clients'));
    }

    public function outDateAllClient()
    {
        $clients = Fclient::whereNull('response')->where('status', '!=', 'done')->WhereDate('next_call', "<", today())->orderBy('created_at')->get();
        return view('admin.Clients.index', compact('clients'));
    }

    public function today()
    {
        $my_name = Auth::user()->name;
        $clients = Fclient::whereNull('response')->where('status', '!=', 'done')->whereDate('next_call', today())->Where('cansultant_name', $my_name)->orderBy('updated_at')->get();
        return view('admin.Clients.index', compact('clients'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function appointmentView(Fclient $client)
    {
        if ($client->created_at <= '2022-05-24') {
            return to_route('client.edit', $client);
        } else {
            return view('admin.Clients.appointment', compact('client'));
        }
    }



    public function appointment(ClientRequest $request, Fclient $client)
    {

        // dd($client);


        $inputs = $request->all();

        $inputs['phone'] = convertNum($client->phone);

        if (preg_match('/^(\+98|98|9)\d{9}$/', $inputs['phone']) or preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['phone'])) {
            // $inputs['phone'] = ltrim($inputs['phone'], '0');
            $inputs['phone'] = substr($inputs['phone'], 0, 2) === '98' ? substr($inputs['phone'], 2) : $inputs['phone'];
            $inputs['phone'] = str_replace("+98", "", $inputs['phone']);
            $inputs['phone'] = strlen($inputs['phone']) === 10 ? "0" . $inputs['phone'] : $inputs['phone'];
            $realTimestampStart = substr($request->published_at, 0, 10);
            $inputs['next_call'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

            $inputs['user_id'] = Auth::user()->id;
            $inputs['status'] = 'consulting';

            $inputs['cansultant_name'] = Auth::user()->name;

            $client->update($inputs);

            $time =  jalaliDate($inputs['next_call'], 'H:i');
            $day =  jalaliDate($inputs['next_call'], '%A, %d %B %Y');

            $text = $client->fullname . ' ' . " عزیز درخواست مشاوره شما با شرکت بیاند یونیورسال ثبت شد. وقت مشاوره شما در ساعت " . $time . " روز " . $day . " میباشد. %0a مشاور ما با شما در تاریخ وساعت مشخص شده تماس خواهند گرفت. ";

            $inputs['phone'] = ltrim($inputs['phone'], '0');
            $whatsapp = 'https://api.whatsapp.com/send?phone=+98' . $inputs['phone'] . '&text=' . $text;

            return Redirect::to($whatsapp);

            // $url = 'https://api.whatsapp.com/send?phone=+989337588847&text=mamad' ;
            // return to_route('admin.index')->with('success', 'client appointment successfully');
        } else {

            return to_route('appointment.view', $client->id)->with('swal-error-phone', 'Wrong number format');
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fclient $client)
    {
        return view('admin.Clients.show', compact('client'));
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
        return view('admin.Clients.edit', compact(['client', 'users', 'courses', 'tags']));
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
        $inputs['phone'] = convertNum($request->phone);
        if (preg_match('/^(\+98|98|9)\d{9}$/', $inputs['phone']) or preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['phone'])) {


            // $inputs['phone'] = ltrim($inputs['phone'], '0');

            $inputs['phone'] = substr($inputs['phone'], 0, 2) === '98' ? substr($inputs['phone'], 2) : $inputs['phone'];
            $inputs['phone'] = str_replace("+98", "", $inputs['phone']);
            $inputs['phone'] = strlen($inputs['phone']) === 10 ? "0" . $inputs['phone'] : $inputs['phone'];

            $realTimestampStart = substr($request->published_at, 0, 10);
            $inputs['next_call'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

            if ($client->user_id === null) {
                $inputs['user_id'] = Auth::user()->id;
            }

            $inputs['cansultant_name'] = Auth::user()->name;
            $inputs['hours'] = $request->hours + $client->hours;



            if ($request->cansultant_name != Auth::user()->name) {

                $emailService = new EmailService();
                $details = [
                    'title' => 'new client has been added to you',
                    'body' => [
                        "name" => $request->fullname,
                        "phone" => $request->phone,
                        "time" => $inputs['next_call']
                    ],
                ];

                $emailService->setDetails($details);
                $emailService->setFrom('noreply@beyonduniversal.com', "Beyonduniversal");

                $cansultant = User::where("name", $request->cansultant_name)->first();

                $emailService->setTo($cansultant->email);

                $massageService = new MessageService($emailService);
                $massageService->send();

                $inputs['cansultant_name'] = $request->cansultant_name;
            }


            if ($request->status == 'done') {

                $emailService = new EmailService();
                $details = [
                    'title' => 'a client has been registered',
                    'body' => [
                        "name" => $request->fullname,
                        "phone" => $request->phone,
                        "time" => $inputs['next_call']
                    ],
                ];

                $emailService->setDetails($details);
                $emailService->setFrom('noreply@beyonduniversal.com', "Beyonduniversal");

                $emailService->setTo(["mreza19374@gmail.com"]);

                $massageService = new MessageService($emailService);
                $massageService->send();
            }

            DB::transaction(function () use ($inputs, $client, $request) {
                $e = Auth::user()->id;
                $user = User::where('id', $e)->first();
                $w['hours'] = Auth::user()->hours + $request->hours;
                $user->update($w);
                $client->update($inputs);
            });


            return to_route('client.my')->with('success', 'client updated');
        } else {

            // return to_route('admin.index')->with('swal-error-phone', 'Wrong number format');

            return back()->withErrors('Wrong number format');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function response(ClientRequest $request, Fclient $client)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['next_call'] = Carbon::now();
        $inputs['status'] = 'cancel';
        if ($request->response == null) {
            $inputs['response'] = "format of this number is incorrect";
            $client->update($inputs);
            return response()->json(['status' => true]);
        }
        $client->update($inputs);
        return to_route('client.my')->with('success', 'client deleted');
    }

    public function restore(Fclient $client)
    {
        $inputs['user_id'] = null;
        $inputs['cansultant_name'] = null;
        $inputs['response'] = null;

        $inputs['next_call'] = null;
        $inputs['status'] = 'consulting';

        $client->update($inputs);
        return to_route('admin.index')->with('success', 'client restored');
    }


    public function deletes()
    {
        $clients = Fclient::whereNotNull('response')->orderBy('updated_at')->get();
        return view('admin.Clients.index', compact('clients'));
    }


    public function search(ClientRequest $request)
    {
        // $q = $request->all();
        $clients = Fclient::where('fullname', 'LIKE', '%' . $request->search . "%")->orWhere('phone', 'LIKE', '%' . $request->search . "%")->orWhere('cansultant_name', 'LIKE', '%' . $request->search . "%")->get();
        return view('admin.Clients.index', compact('clients'));
    }

    public function destroy($id)
    {
        $client = Fclient::find($id);
        $client->delete();
        return to_route('client.deletes.view')->with('success', "Record Deleted Successfully");
    }
}
