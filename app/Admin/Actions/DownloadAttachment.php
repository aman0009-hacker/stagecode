<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Layout\Content;

class DownloadAttachment extends RowAction
{
    public $name = 'Documents Info';
    public function handle(Model $model)
    {
         return $this->response()->success('User request has already approved.')->refresh();
    }
}