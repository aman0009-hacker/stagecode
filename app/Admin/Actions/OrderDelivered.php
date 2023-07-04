<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class OrderDelivered extends RowAction
{
    protected $selector = '.order-delivered';
    public function handle(Request $request)
    {
        // $request ...
        return $this->response()->success('Success message...')->refresh();
    }
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default order-delivered"></a>
HTML;
    }
}