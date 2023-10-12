<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;
use Illuminate\Support\Facades\Log;


class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        try {
            $grid = new Grid(new Category());
            $grid->column('category_id', __('Type'))->display(function ($category_id) {
                return Product::where('id', $category_id)->firstOrFail()->name ?? '';
            });
            $grid->column('name', __('Category Name'));
            $grid->column('created_at', __('Created at'))->display(function ($value) {
                return Carbon::parse($value)->format('Y-m-d H:i');
            });
            $grid->filter(function ($filter) {

                $filter->disableIdFilter();
                $filter->like('name', __('Category Name'));

            });
            $grid->actions(function ($actions) {
                $actions->disableEdit();
                $actions->disableView();
                if (Admin::user()->can('create-post')) {
                    Permission::check('create-post');
                }
            });
            $grid->disableActions();
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->model()->orderBy('created_at', 'desc');
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
        $show = new Show(Category::findOrFail($id));

        $show->field('name', __('Name'));

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
        $form = new Form(new Category());
        $form->select('category_id', __('Product'))->options(function () {
            // Retrieve the products from the database
            $products = Product::pluck('name', 'id');
            // Add a placeholder option
            $products->prepend('-- Select Product --', '');
            return $products;
        });

        $form->text('name', __('Category'))->rules(function ($form) {
            $id = $form->model()->id;
            // Set the validation rule
            return 'required|unique:categories,name,' . $id . ',id';
        });
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