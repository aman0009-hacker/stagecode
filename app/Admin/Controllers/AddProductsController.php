<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use App\Admin\Forms\AddProducts;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;


class AddProductsController extends AdminController
{
    public function index(Content $content)
    {
        $content
            ->title('Yard Management')
            ->body(new AddProducts());
        return $content;
    }
    public function saveData(Request $request)
    {
        echo "success";
    }

}