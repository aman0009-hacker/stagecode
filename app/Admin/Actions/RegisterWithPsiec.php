<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RegisterWithPsiec extends RowAction
{
    public $name = 'Register with PSIEC';

    public function handle(Model $model, Request $request)
    {
        // $model ...
        $model->member_at = $request->member_at;
        $model->save();
        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $this->date('member_at', 'Register At')->required();
    }

}