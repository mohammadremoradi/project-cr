<?php

namespace App\Http\Controllers\admin\client;

use App\Enums\FileType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\ConsumerFileRequest;
use App\Http\Services\File\FileService;
use App\Models\Admin\Fclient;
use App\Models\Front\Consumer\Consumer;
use App\Models\Front\Consumer\ConsumerFile;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;


class ConsumerFileController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:consumer-file', ['only' => [
            'files', 'uploadFileView',
            'uploadFile', 'download', 'status', 'downloadZip', 'deleteFile'
        ]]);
    }

    public function files(Fclient $client)
    {
        $consumer = $client->consumer;
        $files = $consumer->files;
        return view('admin.Clients.consumer.files', compact('files', 'consumer'));
    }



    public function uploadFileView(Consumer $consumer)
    {
        $types =  FileType::getValues();
        return view('admin.Clients.consumer.uploadfile', compact('types', 'consumer'));
    }


    public function uploadFile(ConsumerFileRequest $request, Consumer $consumer, FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')) {

            $fileService->setExclusiveDirectory('Uploads' . DIRECTORY_SEPARATOR . 'consumer' . DIRECTORY_SEPARATOR . $consumer->client->fullname . DIRECTORY_SEPARATOR . $request->type);
            $inputs['file_name'] = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileService->setFileName($inputs['file_name']);
            $result = $fileService->moveToStorage($request->file('file'));
            $fileFormat = $fileService->getFileFormat();
            if ($result === false) {
                return to_route('consumer.files', $consumer->id)->with('swal-error', 'File has not been Uploaded');
            }

            $inputs['file_path'] = $result;
            $inputs['consumer_id'] = $consumer->id;
            $inputs['activation'] = 2;

            // $zip_file = storage_path('Uploads' . DIRECTORY_SEPARATOR .  'consumer' . DIRECTORY_SEPARATOR . $consumer->client->fullname . DIRECTORY_SEPARATOR . $consumer->client->fullname . '.zip');
            // $zip = new ZipArchive();
            // if ($zip->open($zip_file, ZipArchive::CREATE) === TRUE) {
            //     if ($inputs['activation'] == 2) {

            //         $filename = $request->type . DIRECTORY_SEPARATOR . $request['file']->getClientOriginalName();

            //         $path = storage_path($inputs['file_path']);

            //         // dd($path);
            //         $zip->addFile($path, $filename);
            //     }

            //     $zip->close();
            // }
            $inputs['file_name'] = $request->file->getClientOriginalName();

            $file = ConsumerFile::create($inputs);
            return to_route('consumer.files', $consumer->client->id)->with('success', 'file has been uploaded');
        }
    }




    public function download(ConsumerFile $file)
    {
        $pathToFile = storage_path($file->file_path);
        return response()->download($pathToFile);
    }

    public function status(ConsumerFileRequest $request, ConsumerFile $file)
    {
        $file->update($request->all());

        return to_route('consumer.files', $file->consumer->client->id)->with('success', 'status has been changed');
    }


    public function downloadZip(Consumer $consumer)
    {
        $zip_file = storage_path('Uploads' . DIRECTORY_SEPARATOR .  'consumer' . DIRECTORY_SEPARATOR .  $consumer->client->fullname . DIRECTORY_SEPARATOR .  $consumer->client->fullname . '.zip');
        $zip = new ZipArchive();
        $id = $consumer->id;
        $files = ConsumerFile::where('consumer_id', $id)->where('activation', 2)->get();


        if (!$files->isEmpty()) {
            if ($zip->open($zip_file, ZipArchive::CREATE  | ZipArchive::OVERWRITE) === TRUE) {
                foreach ($files as $file) {
                    $filename = $file->type . DIRECTORY_SEPARATOR . $file->file_name;
                    $path = storage_path($file->file_path);
                    $zip->addFile($path, $filename);
                }
                $zip->close();
            }
        } else {
            return back()->with('swal-error', 'nothing to download');
        }


        $pathToFile = storage_path('Uploads' . DIRECTORY_SEPARATOR .  'consumer' . DIRECTORY_SEPARATOR . $consumer->client->fullname . DIRECTORY_SEPARATOR . $consumer->client->fullname . '.zip');


        return response()->download($pathToFile);
    }




    public function deleteFile(ConsumerFile $file)
    {
        if (File::exists(storage_path($file->file_path))) {
            $file->delete();
            // $deletefile = unlink(storage_path($file->file_path));
            // $zip_file_delete = unlink(storage_path('Uploads' . DIRECTORY_SEPARATOR .  'consumer' . DIRECTORY_SEPARATOR . $file->consumer->client->fullname . DIRECTORY_SEPARATOR . $file->consumer->client->fullname . '.zip'));
            // $zip_file = storage_path('Uploads' . DIRECTORY_SEPARATOR .  'consumer' . DIRECTORY_SEPARATOR .  $file->consumer->client->fullname . DIRECTORY_SEPARATOR .  $file->consumer->client->fullname . '.zip');
            // $zip = new ZipArchive();
            // if ($zip->open($zip_file, ZipArchive::CREATE ) === TRUE) {
            //     $id = $file->consumer->id;
            //     $files = ConsumerFile::where('consumer_id', $id)->get();
            //     foreach ($files as $file) {
            //         if ($file->activation == 2) {
            //             $filename = $file->type . DIRECTORY_SEPARATOR . $file->file_name;
            //             $path = storage_path($file->file_path);
            //             $zip->addFile($path, $filename);
            //         }
            //     }
            //     $zip->close();
            // }
            return to_route('consumer.files', $file->consumer->client->id)->with('swal-success', 'file deleted');
        };

        return to_route('consumer.files', $file->consumer->client->id)->with('error', 'file did not find');
    }
}
