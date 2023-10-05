<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ShowDocuments extends RowAction
{
    public $name = 'Documents Info';
    public function handle(Model $model)
    {
        try {
            $id = $model->id;
            session(['current_row_id' => $id]);
            return $this->response()->success('Documents are showing')->refresh()->redirect("/admin/attachments");
        } catch (\Throwable $ex) {

            Log::info($ex->getMessage());
        }
    }
}