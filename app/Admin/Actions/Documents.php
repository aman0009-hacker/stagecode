<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

=======
use Illuminate\Support\Facades\Redirect;
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea

class Documents extends RowAction
{
    public $name = 'Documents';
    public function handle(Model $model)
    {
        return redirect()->route('admin.auth.attachments.index');
    }
}