<?php 

namespace App\Admin\Controllers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Admin\Forms\AddProducts;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Entity;

class AddProductsController extends AdminController
{
    public function index(Content $content)
    {
        $content
            ->title('Yard Management')
            ->body(new AddProducts());
            // if ($result = session('result')) {
            //     $content->row('<pre>'.json_encode($result).'</pre>');
            // }
            return $content;
    }

   
    public function saveData(Request $request)
    {
     echo "success";
    }

}