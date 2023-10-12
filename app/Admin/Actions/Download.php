<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Download extends RowAction
{
    public $name = "Download All";
    public function handle(Model $model)
    {
        try {
            $data = DB::table('attachments')->whereNotNull('fileno')->where('user_id', $model->user_id)->select('filename')->get();
            $filePaths = [];
            foreach ($data as $filename) {
                array_push($filePaths, $filename);
            }
            $userData = DB::table('users')->join('attachments', 'users.id', '=', 'attachments.user_id')->where('attachments.user_id', $model->user_id)->select('users.name')->first();
            $userDataName = $userData->name;
            $zipFileName = $userDataName . '_files_' . rand(10, 1000) . ".zip";
            $zip = new ZipArchive();
            $zipFilePath = public_path("uploads\\") . $zipFileName;
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                foreach ($filePaths as $filePath) {
                    if (File::exists(public_path("uploads/"))) {
                        $fileContent = Storage::disk('admin')->get($filePath->filename);
                        $fileName = basename($filePath->filename);
                        $zip->addFromString($fileName, $fileContent);
                    }
                }
                $zip->close();
                return $this->response()->success('Success!')->download(Config::get('app.url') . "uploads/" . $zipFileName);
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }
}