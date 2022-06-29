<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:setting-user-page', ['only' => ['index']]);
        $this->middleware('permission:setting-user-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:setting-user-promission', ['only' => ['is_admin', 'reset_hours', 'resetPassword']]);
    }


    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();
        return view('admin.Setting.users.index', compact('data'));
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function is_admin(User $user)
    {


        if ($user->is_admin == 0) {
            $user->is_admin = "1";
        } else {
            $user->is_admin = "0";
        }
        $user->save();

        return back();
    }

    public function reset_hours(User $user)
    {
        $user->hours = 0;
        $user->save();
        return back();
    }

    public function resetPassword(User $user)
    {
        $user->password = null;
        $user->save();
        return back();
    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */


    public function create()

    {
        return view('admin.Setting.users.create');
    }

    public function store(Request $request)

    {
        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'phone' => 'numeric'

        ]);

        $input = $request->all();

        $input['is_admin'] = 1;


        $user = User::create($input);


        return redirect()->route('users.index')

            ->with('success', 'User created successfully');
    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $user = User::find($id);

        $roles = Role::pluck('name', 'name')->all();

        $userRole = $user->roles->pluck('name', 'name')->all();



        return view('admin.Setting.users.edit', compact('user', 'roles', 'userRole'));
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

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email,' . $id,

            'password' => 'same:confirm-password',

            'roles' => 'required'

        ]);



        $input = $request->all();

        if (!empty($input['password'])) {

            $input['password'] = Hash::make($input['password']);
        } else {

            $input = Arr::except($input, array('password'));
        }



        $user = User::find($id);

        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();



        $user->assignRole($request->input('roles'));



        return redirect()->route('users.index')

            ->with('success', 'User updated successfully');
    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
}
