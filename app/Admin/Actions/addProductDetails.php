<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class addProductDetails extends RowAction
{
    public $name = 'Add Details';
   

    public function handle(Model $model,Request $request)
    {
        // $model ...
        $model->quantity=$request->Quantity;
        $model->amount=$request->Amount;
        $model->save();


        return $this->response()->success('Details Added Successfully')->refresh();
    }
    public function form()
    {
        $this->text('Quantity', 'Quantity')->required();
        $this->text('Amount', 'Amount')->required();    
    }
}