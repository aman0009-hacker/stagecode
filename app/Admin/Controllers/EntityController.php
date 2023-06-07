<?php

namespace App\Admin\Controllers;

use App\Models\Entity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;

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
        $grid = new Grid(new Entity());
        $grid->column('id', __('Product Name'))->display(function($id)
        {
          $categoryId=Entity::where('id',$id)->first()->entity_id;
          if(isset($categoryId))
          {
          $productId=Category::where('id',$categoryId)->first()->category_id;
          if(isset($productId))
          {
          $productName=Product::where('id',$productId)->first()->name;
          return $productName;
          }
          }
        return "";
        });
        // $grid->column('id', __('Id'));
        $grid->column('entity_id', __('Category Name'))->display(function($entity_id){
            return Category::where('id',$entity_id)->firstOrFail()->name ?? '';
         });
        $grid->column('name', __('Entity Name'));
        $grid->column('description', __('Description'));
        $grid->column('size', __('Size'));
        $grid->column('diameter', __('Diameter'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('remaining', __('Remaining'));
        $grid->column('measurement', __('Measurement'));
        $grid->column('created_at', __('Created at'))->display(function ($value) {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        });
        // $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });


        $grid->filter(function ($filter) {
            // $filter->notIn('id', __('Id'));
            $filter->disableIdFilter();
            $filter->like('name', __('Entity Name'));
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
        $show = new Show(Entity::findOrFail($id));
        // $show->field('id', __('Id'));
        $show->field('name', __('Entity Name'));
        $show->field('description', __('Description'));
        $show->field('size', __('Size'));
        $show->field('diameter', __('Diameter'));
        $show->field('quantity', __('Quantity'));
        $show->field('remaining', __('Remaining'));
        $show->field('measurement', __('Measurement'));
        // $show->field('entity_id', __('Entity id'));
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
    {
        $form = new Form(new Entity());

        $form->select('product_id', 'Product')
        ->options(function () {
            // Retrieve the products from the database
            $products = Product::pluck('name', 'id');

            // Add a placeholder option
            $products->prepend('-- Select Product --', '');

            return $products;
        })
        ->rules('required')->load('category_id', '/admin/load-categories');
        $form->select('category_id', 'Category')->rules('required')->load('entity_id', '/admin/load-entities');

        // $form->text('entity_id', 'Entity')->;



        $form->text('name', __('Entity Name'));
        $form->text('description', __('Description'));
        $form->text('size', __('Size'));
        $form->text('diameter', __('Diameter'));
        $form->number('quantity', __('Quantity'));
        $form->number('remaining', __('Remaining'));
        $form->text('measurement', __('Measurement'));
        $form->text('entity_id', __('Category'));


        $form->submitted(function (Form $form) {
            $form->ignore('product_id');
            $form->ignore('category_id');
         });

        return $form;
    }
}
