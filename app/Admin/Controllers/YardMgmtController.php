<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;

use App\Admin\Forms\YardMgmt;

use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Models\Category;
<<<<<<< HEAD

=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea

class YardMgmtController extends AdminController
{
    public function index(Content $content)
    {
        $content
            ->title('Yard Management')
            ->body(new YardMgmt());
        if ($result = session('result')) {
            $content->row('<pre>' . json_encode($result) . '</pre>');
        }
        return $content;
    }

    public function loadCategories(Request $request)
    {
        $product_id = $request->input('q');
        // Retrieve the categories based on the selected product
        $categories = Category::where('category_id', $product_id)->pluck('name', 'id');
        // Add a placeholder option
        return $categories;
    }

    public function loadEntities(Request $request)
    {
<<<<<<< HEAD

=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        $category_data = $request->input('q');
        if (isset($category_data) && $category_data != "-- Select Category --") {
            $category_id = Category::where("name", $category_data)->first()->id;
            $category_id = Category::where("name", $category_data)->pluck('id', 'category_id');
            return response()->json($category_id);
        }
    }

    public function saveData(Request $request)
    {
        echo "success";
    }

}