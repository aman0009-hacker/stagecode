<?php 

namespace App\Admin\Controllers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Admin\Forms\YardMgmt;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Entity;

class YardMgmtController extends AdminController
{
    public function index(Content $content)
    {
        $content
            ->title('Yard Management')
            ->body(new YardMgmt());
            if ($result = session('result')) {
                $content->row('<pre>'.json_encode($result).'</pre>');
            }
            return $content;
    }

    public function loadCategories(Request $request)
    {
        $product_id = $request->input('q');

        // Retrieve the categories based on the selected product
        $categories = Category::where('category_id', $product_id)->pluck('name', 'id');

        // Add a placeholder option
        //$categories->prepend('-- Select Category --', '');

        return $categories;
    }




    public function loadEntities(Request $request)
    {
        //$category_id = $request->input('category_id');
        $category_data = $request->input('q');

        if(isset($category_data) && $category_data!="-- Select Category --")
        {
        $category_id=Category::where("name",$category_data)->first()->id;
        //$entities = Entity::where('entity_id', $category_id)->pluck('entity_id', 'id');
        $category_id=Category::where("name", $category_data)->pluck('id', 'category_id');
        return response()->json($category_id);
        }
    }




    public function saveData(Request $request)
    {
     echo "success";
    }

}

