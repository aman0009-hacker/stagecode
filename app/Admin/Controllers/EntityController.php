<?php

namespace App\Admin\Controllers;

use App\Models\Entity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use App\Models\Category;
use App\Admin\Actions\addProductDetails;
use App\Admin\Actions\excelfile;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;
use Illuminate\Support\Facades\Log;

class EntityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Entity';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        try {
            $grid = new Grid(new Entity());
            $grid->column('id', __('Type'))->display(function ($id) {
                $categoryId = Entity::where('id', $id)->first()->entity_id;
                if (isset($categoryId)) {
                    $productId = Category::where('id', $categoryId)->first()->category_id;
                    if (isset($productId)) {
                        $productName = Product::where('id', $productId)->first()->name;
                        return $productName;
                    }
                }
                return "";
            });
            $grid->column('entity_id', __('Category'))->display(function ($entity_id) {
                return Category::where('id', $entity_id)->firstOrFail()->name ?? '';
            });
            $grid->column('name', __('Material'));
            $grid->column('description', __('Description'));
<<<<<<< HEAD
            $grid->column('created_at', __('Created At'))->display(function ($value) {
                return Carbon::parse($value)->format('Y-m-d H:i');
            });
=======

            $grid->column('created_at', __('Created At'))->display(function ($value) {

                return Carbon::parse($value)->format('Y-m-d H:i');
            });

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name', __('Material'));

            });
            $grid->actions(function ($actions) {
                $actions->disableEdit();
                $actions->disableDelete();

                $auth=admin::user();

                if($auth->inRoles(['Admininstrator','yard-supervisor']))
                {

                    $actions->add(new addProductDetails);
                }
                $actions->disableView();
                if (Admin::user()->can('create-post')) {
                    Permission::check('create-post');
                }
            });
            $grid->tools(function ($tools) {
                $tools->append(new excelfile());

            });

            $grid->disableRowSelector();
            $grid->disableCreateButton();

            return $grid;
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
            return $grid;
        }
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Entity::findOrFail($id));
<<<<<<< HEAD

=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        $show->field('name', __('Entity Name'));
        $show->field('description', __('Description'));
        $show->field('size', __('Size'));
        $show->field('diameter', __('Diameter'));
<<<<<<< HEAD

=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Entity());
<<<<<<< HEAD


=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        $form->select('product_id', 'Product')
            ->options(function () {
                // Retrieve the products from the database
                $products = Product::pluck('name', 'id');

                // Add a placeholder option
                $products = ['' => '-- Select Product --'] + $products->toArray();

                return $products;
            })
            ->rules('required')
            ->default('')
            ->load('category_id', '/admin/load-categories');
        $form->select('category_id', 'Category')->rules('required')->load('entity_id', '/admin/load-entities');

        $form->text('name', __('Entity Name'));
        $form->text('description', __('Description'));
        $form->text('size', __('Size'));
        $form->text('diameter', __('Diameter'));

        $form->select('entity_id', __('Category ID'));

        $form->submitted(function (Form $form) {
            $form->ignore('product_id');
            $form->ignore('category_id');
        });
        $form->hidden('supervisorid')->default(Admin::user()->id);
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}