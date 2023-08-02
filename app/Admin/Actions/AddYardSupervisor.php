<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Log;
use App\Models\Yard;
use App\Models\AdminUser;

class AddYardSupervisor extends RowAction
{
    public $name = 'Add Supervisor';
    public function handle(Model $model)
    {
        try {
            // $id = $model->id;
            // $supervisorName = AdminUser::where('id', $supervisorid)->first()->username;
            // return $supervisorName ?? "N/A";
        } catch (\Throwable $ex) {
            //return $this->response()->error('Oops! Sending mail has encountered some internal problem');
            Log::info($ex->getMessage());
        }
    }
}