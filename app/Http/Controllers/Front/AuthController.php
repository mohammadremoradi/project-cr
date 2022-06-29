<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\AuthRequest;
use App\Http\Requests\Front\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function login()
    {
        return view('front.auth.login');
    }

    public function checkPassword(AuthRequest $request)
    {
        $inputs = $request->all();
        if (filter_var($inputs['identity'], FILTER_VALIDATE_EMAIL)) {
            $type = 0;
            $user = User::where('email', $inputs['identity'])->first();
            if (empty($user)) {
                $errorText = 'ایمیل شما نا معتبر میباشد';

                return redirect()->route('login.form')->withErrors(['identity' => $errorText]);

                // return response()->json(['status' => 'false', 'error' => $errorText]);
            } else {
                if ($user->password == null) {
                    // return response()->json(['status' => 'true', 'error' => null, 'password' => null]);
                    return redirect()->route('password.view', $user->id);
                }

                return redirect()->route('password.view', $user->id);

                // return response()->json(['status' => 'true', 'error' => null]);
            }
        }
        if (preg_match('/^(\+98|98|9)\d{9}$/', $inputs['identity']) or preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['identity'])) {
            $type = 1; // 0 => mobile;
            $inputs['identity'] = substr($inputs['identity'], 0, 2) === '98' ? substr($inputs['identity'], 2) : $inputs['identity'];
            $inputs['identity'] = str_replace('+98', '', $inputs['identity']);
            $inputs['identity'] = strlen($inputs['identity']) === 10 ? "0" . $inputs['identity'] : $inputs['identity'];

            $user = User::where('phone', $inputs['identity'])->first();
            if (empty($user)) {
                $errorText = 'شماره شما نا معتبر میباشد';
                // return response()->json(['status' => 'false', 'error' => $errorText]);
                return redirect()->route('login.form')->withErrors(['identity' => $errorText]);
            } else {

                if ($user->password == null) {
                    // return response()->json(['status' => 'true', 'error' => null, 'password' => null]);
                    return redirect()->route('password.view', $user->id);
                }

                return redirect()->route('password.view', $user->id);


                // return response()->json(['status' => 'true',  'error' => null]);
                // return redirect()->route('password.view', $user->id);
            }
        } else {
            $errorText = 'شناسه ورودی شما نه شماره موبایل است نه ایمیل';
            return redirect()->route('login.form')->withErrors(['identity' => $errorText]);
        }
    }


    public function passwordView(User $user)
    {
        if ($user->password == null) {
            return view('front.auth.register_password', compact('user'));
        } else {
            return view('front.auth.login_password', compact('user'));
        }
    }



    public function setPassword(Request $request, User $user)
    {
        $inputs = $request->all();
        if ($user->password == null) {

            $inputs = $request->validate([
                'password' => 'required|min:8|max:30|confirmed',
            ]);

            $inputs['password'] = Hash::make($inputs['password']);
            $inputs['read_at'] = now();
            $user->update($inputs);
            auth()->login($user, TRUE);
            return to_route('in')->with('success', "Account successfully registered.");
        } else {
            $inputs = $request->validate([
                'password' => 'required|min:8|max:30',
            ]);

            $credentials['password'] = $request->password;
            if ($user->email) {
                $credentials['email'] = $user->email;
            } else {
                $credentials['phone'] = $user->phone;
            }
            if (Auth::attempt($credentials, TRUE)) {
                return to_route('in')
                    ->withSuccess('Signed in');
            }
            $errorText = 'پسورد شما معتبر نمیباشد';
            return redirect()->back()->withErrors(['password' => $errorText]);
        }
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
