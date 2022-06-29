<?php

use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\Admin\Accounting\Advertising\Advertisecontroller;
use App\Http\Controllers\Admin\Accounting\Advertising\BudgetController;
use App\Http\Controllers\Admin\Accounting\Advertising\SourseController;
use App\Http\Controllers\Admin\Client\ConsumerController;
use App\Http\Controllers\Admin\Client\ConsumerFileController;
use App\Http\Controllers\Admin\FclientController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Notify\MailFileController;
use App\Http\Controllers\Admin\Notify\SmsController;
use App\Http\Controllers\Admin\Setting\ConsumerStatusController;
use App\Http\Controllers\Admin\Setting\ServicesController;
use App\Http\Controllers\Admin\Setting\TagController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\IndexController as FrontIndexController;
use App\Http\Controllers\Front\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('front.auth.login');
    return redirect('clients/login');
})->middleware('consumerCheck')->name('in');


Route::group(['prefix' => 'adpanel'], function () {
    Route::resource('roles', RoleController::class)->middleware('adminCheck');

    Route::group(['middleware' => ['auth:sanctum', 'verified', 'adminCheck']], function () {
        Route::get('/', [IndexController::class, 'index'])->name('admin.index');

        // setting

        Route::put('users/admin/reset/{user}', [UserController::class, 'reset_hours'])->name('reset_hours');
        Route::put('users/admin/{user}', [UserController::class, 'is_admin'])->name('is_admin');
        Route::put('users/admin/reset/password/{user}', [UserController::class, 'resetPassword'])->name('user.reset.password');
        Route::resource('users', UserController::class);
        Route::put('tags-client/{client}', [TagController::class, "removeTagClient"])->name('client.remove.tag');
        Route::resource('tags', TagController::class);
        Route::resource('services', ServicesController::class);
        Route::resource('register/client/status', ConsumerStatusController::class);

        // clients

        Route::controller(FclientController::class)->group(function () {
            Route::get('clients', 'index')->name('client.index');
            Route::get('client-appointment/{client}', 'appointmentView')->name('appointment.view');
            Route::get('client-delete', 'deletes')->name('client.deletes.view');
            Route::put('client-appointment/update/{client}', 'appointment')->name('appointment.update');
            Route::post('client/response/{client}', 'response')->name('client.response');
            Route::get('client/myClient', 'myClient')->name('client.my');
            Route::get('client/today', 'today')->name('client.today');

            Route::get('client/show/{client}', 'show')->name('client.show');
            Route::get('client/edit/{client}', 'edit')->name('client.edit');
            Route::put('client/update/{client}', 'update')->name('client.update');

            Route::get('client/response/{client}', 'restore')->name('client.restore');
            Route::get('client/survay/{client}', 'survay')->name('client.survay');

            Route::get('search', 'search')->name('search.clients');

            Route::get('client/outdate/myclient', 'outDateMyClient')->name('client.outdate.my');
            Route::get('client/outdate/allclient', 'outDateAllClient')->name('client.outdate.all');
        });


        // applicant

        Route::controller(ConsumerController::class)->group(function () {
            Route::group(['prefix' => 'applicant'], function () {
                Route::get('index', 'index')->name('consumer.index');
                Route::get('waiting', 'waiting')->name('consumer.waiting');
                Route::get('show/{client}', 'registerView')->name('consumer.register.view');
                Route::post('register/{client}', 'register')->name('consumer.register');
                Route::get('edit/{client}', 'edit')->name('consumer.edit');
                Route::put('update/{client}', 'update')->name('consumer.update');
            });
        });


        // consumer file

        Route::controller(ConsumerFileController::class)->group(function () {
            Route::group(['prefix' => 'consumer/file'], function () {
                Route::get('consumer/files/{client}', 'files')->name('consumer.files');
                Route::get('consumer/file/upload/{consumer}', 'uploadFileView')->name('consumer.upload.file.view');
                Route::post('consumer/file/{consumer}', 'uploadFile')->name('consumer.upload.file');
                Route::get('consumer/file/download/{file}', 'download')->name('consumer.download.file');
                Route::delete('consumer/file/delete/{file}', 'deleteFile')->name('consumer.delete.file');
                Route::get('consumer/file/download/zip/{consumer}', 'downloadZip')->name('consumer.download.file.zip');

                Route::put('consumer/file/status/{file}', 'status')->name('consumer.file.status');
            });
        });




        Route::resource('All-clients', FclientController::class);

        // notify
        Route::resource('notify/sms', SmsController::class);
        Route::resource('notify/email', EmailController::class);

        Route::controller(MailFileController::class)->group(function () {
            Route::get('notify/email-file/{email}', 'index')->name('mail-file.index');
            Route::get('notify/email-file/{email}/create', 'create')->name('mail-file.create');
            Route::post('notify/email-file/{email}/store', 'store')->name('mail-file.store');
            Route::get('notify/email-file/{file}/edit', 'edit')->name('mail-file.edit');
            Route::put('notify/email-file/{file}/update', 'update')->name('mail-file.update');
            Route::delete('notify/email-file/{file}/delete', 'destroy')->name('mail-file.destroy');
        });

        // Accounting

        Route::prefix('accounting')->group(function () {

            Route::get('{advertise}/download', [Advertisecontroller::class, 'download'])->name('receipt.download');
            Route::resource('advertise', Advertisecontroller::class);
            Route::resource('sourse', SourseController::class);
            Route::resource('budget', BudgetController::class);
        });




        Route::prefix('statistics')->group(function () {
            Route::get('survey', [SurveyController::class, 'index'])->name('survey.index');
            Route::get('survey/{survey}', [SurveyController::class, 'show'])->name('survey.show');

            Route::get('survey/chart', [SurveyController::class, 'chart'])->name('survey.chart');
        });
    });
});

Route::group(['prefix' => 'clients', 'middleware' => ['consumerCheck']], function () {

    Route::get('login', [AuthController::class, 'login'])->name('login.form');
    Route::post('login/check/password', [AuthController::class, 'checkPassword'])->name('check.password');
    Route::get('login/password/{user}', [AuthController::class, 'passwordView'])->name('password.view');
    Route::put('login/password/set/{user}', [AuthController::class, 'setPassword'])->name('set.password');

    // consumer index
    Route::get('/', [FrontIndexController::class, 'index'])->name('front.consumer.index');
});


Route::get('survey/{client}/{user}', [SurveyController::class, 'create'])->name('survey.create');
Route::post('survey/post/{client}/{user}', [SurveyController::class, 'store'])->name('survey.store');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'consumerCheck'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
