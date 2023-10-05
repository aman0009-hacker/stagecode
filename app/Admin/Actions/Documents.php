<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;

class Documents extends RowAction
{
    public $name = 'Documents';
    public function handle(Model $model)
    {
        return redirect()->route('admin.auth.attachments.index');
    }
}