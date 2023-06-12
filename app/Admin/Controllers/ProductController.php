<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;


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

        // $grid->actions(function ($actions) {
        //     $actions->disableEdit();
        // });

      
     
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
       
          $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();
           if (Admin::user()->can('create-post')) {
                Permission::check('create-post');
            }
        });
        $grid->model()->orderBy('created_at', 'desc');
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
        $form->text('name', __('Name'))->rules(function($form)
        {
         $id=$form->model()->id;
         // Set the validation rule
         return 'required|unique:products,name,' . $id . ',id';
        });
        return $form;
    }

    // public function create(Content $content)
    // {
    //     // check permission, only the roles with permission `create-post` can visit this action
    //     Permission::check('create-post');
    //     $content=new Content();
    //     return $content;
    // }
}
