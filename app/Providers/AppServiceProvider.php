<?php

namespace App\Providers;

use App\Models\Admin\Fclient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $clients=  Fclient::where('next_call' , null)->get();
        // dd($m->count());

        view()->composer('admin.layouts.header', function ($view) {
            $my_name = Auth::user()->name;
            // $num = Fclient::whereNull('response')->whereDate('next_call', today())->Where('cansultant_name', $my_name)->count();

            $view->with('unseenClients', Fclient::where('next_call', null)->get());
            $view->with('unseenUsers', User::whereNull('read_at')->get());
        });

        view()->composer('admin.layouts.sidebar', function ($view) {
            $my_name = Auth::user()->name;
            $view->with('today_number', Fclient::whereNull('response')->whereDate('next_call', today())->Where('cansultant_name', $my_name)->whereNot('status', 'done')->count());
            $view->with('waiting', Fclient::where('status', 'done')->where('waiting', 0)->count());
        });
    }
}
