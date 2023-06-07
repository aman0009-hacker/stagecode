<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;


class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());
        // $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
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
            $filter->like('name', __('Name'));
            // $filter->column(1 / 2, function ($filter) {
            //   $filter->like('name', __('First Name'));
            //   $filter->like('email', __('Email'));
      
            // });
            // $filter->column(1 / 2, function ($filter) {
            //   $filter->like('last_name', __('Last Name'));
            //   $filter->like('contact_number', __('Contact'));
            // });
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
        $show = new Show(Product::findOrFail($id));
        // $show->field('id', __('Id'));
        $show->field('name', __('Name'));
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
        $form = new Form(new Product());
        $form->text('name', __('Name'));
        return $form;
    }
}
