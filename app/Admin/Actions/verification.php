<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Log;
use App\Models\Yard;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class verification extends RowAction
{
    public $name = 'Verification';
    public function handle(Model $model, Request $request)
    {
        try {
            if($model->is_verified==1)
            {

                return $this->response()->success("Saved Successfully")->refresh();
            }
            else
            {
                return $this->response()->error("Email authentication failed")->refresh();
            }

            }
         catch (\Throwable $ex) {
            //return $this->response()->error('Oops! Sending mail has encountered some internal problem');
            Log::info($ex->getMessage());
        }
    }


        public function form()
        {
           $this->hidden('main')->attribute('class','emailotpcheck')->value($this->getKey());
            $this->email('email')->attribute('class','emailverification')->rules('required')->value('example@mail.com');
        }
}
