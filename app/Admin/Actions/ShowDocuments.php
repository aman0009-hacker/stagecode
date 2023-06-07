<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Layout\Content;

class ShowDocuments extends RowAction
{
    public $name = 'Documents Info';

    public function handle(Model $model)
    {
        $id = $model->id;
        session(['current_row_id' => $id]);
        return $this->response()->success('Documents are showing')->refresh()->redirect("/admin/attachments");
    }



}