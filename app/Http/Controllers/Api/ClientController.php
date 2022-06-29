<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Fclient;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function store(Request $request)
    {
        Fclient::create($request->toArray());

        return response()->json(["massage" => "اطلاعات شما با موفقیت ارسال شد"], 201);
    }
}
