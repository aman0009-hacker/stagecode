<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Documents extends RowAction
{
    public $name = 'Documents';

    public function handle(Model $model)
    {
        return redirect()->route('admin.auth.attachments.index');
    }
}