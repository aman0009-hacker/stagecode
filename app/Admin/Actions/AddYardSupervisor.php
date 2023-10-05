<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\Yard;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class AddYardSupervisor extends RowAction
{
    public $name = 'Add Supervisor';
    public function handle(Model $model, Request $request)
    {
        try {
            $id = $request->user;
            if (isset($id) && !empty($id)) {
                $yard = Yard::find($model->id);
                $yard->supervisorid = $id;
                $yard->save();
                return $this->response()->success("Saved Successfully")->refresh();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }


    public function form()
    {
        $supervisors = AdminUser::whereHas('roles', function ($query) {
            $query->where('name', 'YardCreator');
        })->whereNotIn('id', Yard::whereNotNull('supervisorid')->pluck('supervisorid')->toArray())
            ->pluck('username', 'id')
            ->toArray();
        // Add the select field to the form
        $this->select('user', 'Supervisor Username')->options($supervisors);
    }
}