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
        $grid = new Grid(new Category());
        $grid->column('category_id', __('Product Name'))->display(function($category_id){
          return Product::where('id',$category_id)->firstOrFail()->name ?? '';
        });
        // $grid->column('id', __('Id'));
        $grid->column('name', __('Category Name'));
        $grid->column('created_at', __('Created at'))->display(function ($value) {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        });
        //$grid->column('updated_at', __('Updated at'));
        // $grid->actions(function ($actions) {
        //     $actions->disableEdit();
        // });

        $grid->filter(function ($filter) {
            // $filter->notIn('id', __('Id'));
            $filter->disableIdFilter();
            $filter->like('name', __('Category Name'));
            // $filter->column(1 / 2, function ($filter) {
            //   $filter->like('name', __('First Name'));
            //   $filter->like('email', __('Email'));
      
            // });
            // $filter->column(1 / 2, function ($filter) {
            //   $filter->like('last_name', __('Last Name'));
            //   $filter->like('contact_number', __('Contact'));
            // });
          });


          $grid->actions(function ($actions) {
            $actions->disableEdit();
            if (Admin::user()->can('create-post')) {
                Permission::check('create-post');
            }
        });


        return $grid;
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
        // $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        // $show->field('category_id', __('Category id'));
        $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {        $form = new Form(new Category());
        $form->select('category_id', __('Product'))->options(function () {
            // Retrieve the products from the database
            $products = Product::pluck('name', 'id');

            // Add a placeholder option
            $products->prepend('-- Select Product --', '');

            return $products;
        });

        
        // $form->text('name', __('Category'));


        $form->text('name', __('Category'))->rules(function($form)
        {
         $id=$form->model()->id;
         // Set the validation rule
         return 'required|unique:categories,name,' . $id . ',id';
        });


        return $form;
    }
}
