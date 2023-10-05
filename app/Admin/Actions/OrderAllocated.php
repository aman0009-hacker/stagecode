<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class OrderAllocated extends RowAction
{
    public $name = 'Allocate';
    public function handle(Model $model, Request $request)
    {
        // $request ...
        $requestData = $request->all();
        return $this->response()->success('Success message...')->refresh();
    }
}