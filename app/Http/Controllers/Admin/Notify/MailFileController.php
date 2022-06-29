<?php

namespace App\Http\Controllers\admin\notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Admin\Notify\Email;
use App\Models\Admin\Notify\MailFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Services\Message\MessageService;

class MailFileController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:email-file', ['only' => [
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
    public function index(Email $email)
    {

        return view('admin.Notify.email-file.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
        return view('admin.Notify.email-file.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')) {
            $fileService->setExclusiveDirectory('Uploads' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $email->subject . DIRECTORY_SEPARATOR . 'email-files');
            $inputs['file_name'] = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileService->setFileName($inputs['file_name']);
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
            if ($request->saveAs == 'public') {
                $result = $fileService->moveToPublic($request->file('file'));
            }

            if ($request->saveAs == 'private') {
                $result = $fileService->moveToStorage($request->file('file'));
            }

            $fileFormat = $fileService->getFileFormat();

            if ($result === false) {
                return to_route('mail-file.index', $email->id)->with('swal-error', 'File has not been Uploaded');
            }
        }


        $inputs['public_mail_id'] = $email->id;
        $inputs['file_path'] = $result;
        $inputs['file_size'] = $fileSize;
        $inputs['file_type'] = $fileFormat;
        $file = MailFile::create($inputs);
        return to_route('mail-file.index', $email->id)->with('swal-success', 'File has been Uploaded');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MailFile $file)
    {
        return view('admin.notify.email-file.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailFileRequest $request, MailFile $file, FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')) {
            if (!empty($file->file_path)) {
                if ($file->saveAs == 'private') {

                    $fileService->deleteFile($file->file_path, true);
                }
                if ($file->saveAs == 'public') {
                    $fileService->deleteFile($file->file_path);
                }
            }

            $fileService->setExclusiveDirectory('Uploads' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $file->email->subject . DIRECTORY_SEPARATOR . 'email-files');

            $inputs['file_name'] = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileService->setFileName($inputs['file_name']);



            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();

            if ($request->saveAs == 'public') {
                $result = $fileService->moveToPublic($request->file('file'));
            }

            if ($request->saveAs == 'private') {
                $result = $fileService->moveToStorage($request->file('file'));
            }

            $fileFormat = $fileService->getFileFormat();
        }
        if ($result === false) {
            return to_route('mail-file.index', $file->email->id)->with('swal-error', 'file didnt');
        }
        $inputs['file_path'] = $result;
        $inputs['file_size'] = $fileSize;
        $inputs['file_type'] = $fileFormat;
        $file->update($inputs);
        return to_route('mail-file.index', $file->email->id)->with('swal-success', 'File has been Uploaded');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailFile $file)
    {
        $result = $file->delete();
        return to_route('mail-file.index', $file->email->id)->with('swal-success', 'file deleted');
    }
}
