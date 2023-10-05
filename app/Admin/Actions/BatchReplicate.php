<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attachment;
use App\Models\User;
use ZipArchive;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BatchReplicate extends BatchAction
{
    public $name = 'Download';
    public $selector = '.download-btn';
    public function handle(Collection $collection)
    {
        try {
            $filePaths = [];
            foreach ($collection as $model) {
                $data = Attachment::where('user_id', $model->user_id)
                    ->where('id', $model->id)
                    ->whereNotNull('fileno')
                    ->select('filename')
                    ->get();
                foreach ($data as $filename) {
                    array_push($filePaths, $filename);
                }
            }
            if (isset($filePaths) && count($filePaths) > 0) {
                $downloadFile = $this->download($model, $filePaths);
                return $this->response()->success('Success!')->download($downloadFile);
            } else {
                return $this->response()->error('Oops! No file or file is corrupt internally');
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }


    public function download(Model $model, $filePaths)
    {
        try {
            $zipFileName = "";
            if (isset($filePaths) && count($filePaths) > 0) {
                $userData = User::join('attachments', 'users.id', '=', 'attachments.user_id')
                    ->where('attachments.user_id', $model->user_id)
                    ->select('users.name')
                    ->first();
                $userDataName = $userData->name;
                $zipFileName = $userDataName . '_files_' . rand(10, 1000) . ".zip";
                $zip = new ZipArchive();
                $zipFilePath = public_path("uploads/") . $zipFileName;
                if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                    foreach ($filePaths as $filePath) {
                        if (File::exists(public_path("uploads/"))) {
                            $fileContent = Storage::disk('admin')->get($filePath->filename);
                            $fileName = basename($filePath->filename);
                            $zip->addFromString($fileName, $fileContent);
                        }
                    }
                    $zip->close();
                    return Config::get('app.url') . "uploads/" . $zipFileName;
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }

    }
}