<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;



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
    try {
      $grid = new Grid(new Product());
<<<<<<< HEAD

      $grid->column('name', __('Name'));
      $grid->column('created_at', __('Created At'))->display(function ($value) {

        return Carbon::parse($value)->format('Y-m-d H:i');
      });

=======
      $grid->column('name', __('Name'));
      $grid->column('created_at', __('Created At'))->display(function ($value) {
        return Carbon::parse($value)->format('Y-m-d H:i');
      });
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
      $grid->filter(function ($filter) {
        $filter->disableIdFilter();
        $filter->column(1 / 2, function ($filter) {
          $filter->like('name', __('First Name'));
          $filter->like('email', __('Email'));
        });
        $filter->column(1 / 2, function ($filter) {
          $filter->like('last_name', __('Last Name'));
          $filter->like('contact_number', __('Contact'));
        });
      });

      $grid->disableActions();
      $grid->disableFilter();
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
    $show = new Show(Product::findOrFail($id));
<<<<<<< HEAD

    $show->field('name', __('Name'));
    $show->field('created_at', __('Created at'));

=======
    $show->field('name', __('Name'));
    $show->field('created_at', __('Created at'));
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
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
    $form->text('name', __('Name'))->rules(function ($form) {
      $id = $form->model()->id;
      // Set the validation rule
      return 'required|unique:products,name,' . $id . ',id';
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