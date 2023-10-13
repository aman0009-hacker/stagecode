<?php

namespace App\Admin\Controllers;

use App\Models\Records;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;
use Illuminate\Support\Facades\Log;
use App\Models\Yard;
use App\Models\AdminUser;




class YardSupervisorManagementController extends AdminController
{
  private $supervisorIdAdmin;
  /**
   * Title for current resource.
   *
   * @var string
   */
  protected $title = 'Yard Records';

  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function grid()
  {
    try {
      $grid = new Grid(new Records());
      $grid->column('adminUser.name', __('Supervisor Name'));
      $grid->column('date', __('Date'))->display(function ($value) {
        return Carbon::parse($value)->format('Y-m-d');
      });
      $grid->column('product', __('Product'));
      $grid->column('quantity', __("Quantity in Ton's"));
      $grid->column('amount', __("Commission amount per Ton's"));
      $grid->column('Total commission')->display(function () {
        return $this->quantity * $this->amount;
      });
      $grid->column('description', __('Description'))->display(function ($value) {
        if ($value === null) {
          return "N/A";
        } else {
          return $value;
        }
      });

      $grid->filter(function ($filter) {

        $filter->disableIdFilter();
        if (\Auth::user()->name === "Administrator") {
          $filter->like('supervisor_id', __('supervisor Name'))->select(AdminUser::pluck('name', 'id'));

        }
        $filter->between('created_at', 'Select Date')->date();

      });
      $grid->actions(function ($actions) {
        $actions->disableEdit();
        $actions->disableView();
        $actions->disableDelete();
        //new code
        if (Admin::user()->can('create-post')) {
          Permission::check('create-post');
        }
        //new code
      });
      $grid->disableActions();

      //new code

      if (Admin::user()->inRoles(['admin', 'administrator', 'Administartor'])) {
        // If user has one of the specified roles, show all records
        $yardRecords = Yard::where('supervisorid', Admin::user()->id)->value('yardplace');
        if (isset($yardRecords)) {
          $grid->setTitle($yardRecords . " Yard");
        } else {
          $grid->setTitle("");
        }
        $grid->model()->orderBy('created_at', 'desc');
      } else {
        // Otherwise, show only records where supervisorid matches the login ID
        $yardRecords = Yard::where('supervisorid', Admin::user()->id)->value('yardplace');
        if (isset($yardRecords)) {
          $grid->setTitle($yardRecords . " Yard");
        } else {
          $grid->setTitle("");
        }
        $grid->model()->where('supervisor_id', Admin::user()->id)->orderBy('created_at', 'desc');
      }
      //new code
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
    $show = new Show(Records::findOrFail($id));
    $show->field('product', __('Product'));
    $show->field('quantity', __('Quantity'));
    $show->field('description', __('Description'));
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
    $form = new Form(new Records());

    return $form;

  }
}