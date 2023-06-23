<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\AttachmentController;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Layout\Content;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\HtmlString;
use Encore\Admin\Widgets\TableEditable;
use Encore\Admin\Grid\NestedGrid;
use Encore\Admin\Widgets\Table;
use App\Admin\Actions\Rejected;
use App\Admin\Actions\Data;
use App\Admin\Actions\ShowDocuments;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class UserController extends AdminController
{
  /**
   * Title for current resource.
   *
   * @var string
   */
  protected $title = 'User';



  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function grid()
  {
    $grid = new Grid(new User());
    // $grid->column('id', __('Id'));
    $grid->column('name', __('First Name'));
    $grid->column('last_name', __('Last Name'));
    $grid->column('email', __('Email'));
    $grid->column('contact_number', __('Contact Number'));
    $grid->column('attachment', 'Info')->display(function ($comments) {
      //$count = count($comments);
      //return "<span class='label label-warning'>{$count}</span>";
      return "documents";
    })->expand(function ($model) {
      $comments = $model->attachment()->take(10)->where('fileno', 'IS NOT', null)->get()->map(function ($comment) {
        return $comment->only(['file_type', 'fileno', 'created_at']);
      });
      return new Table(['Document Type', 'Document No', 'Release Time'], $comments->toArray());
    });
    $grid->column("approved", __('Status'))->display(function ($value) {
      if (isset($value) && $value === 1) {
        return "Approved";
      } else if (isset($value) && $value === 0) {
        return "New";
      } else if (isset($value) && $value === 2) {
        return "Rejected";
      }
    });
    // ->expand(function ($model) {
    //         $query = DB::table('comments')->where('approved', $model->approved)->where('admin_id',Admin::user()->id)->get();
    //         if ($model->approved == 0) {
    //             return "                                                                           "."No Status Found!!!!!!!!!";
    //         } else if (isset($query) && count($query) > 0) {
    //             $table = '<table class="table ms-4">
    //             <thead>
    //                 <tr>
    //                     <th scope="col">Status</th>
    //                     <th scope="col">Updated At</th>
    //                     <!-- Add more table headers as needed -->
    //                 </tr>
    //             </thead>
    //             <tbody>';
    //             foreach ($query as $query) {
    //                 $table .= '<tr>
    //                     <td>' . $query->comment . '</td>
    //                     <td>' . $query->approved_at . '</td>
    //                     <!-- Add more table cells as needed -->
    //                 </tr>';
    //             }
    //             $table .= '</tbody></table>';
    //             return $table;
    //         }
    //  });
    $grid->export(function ($export) {
      //$export->filename('Filename.csv');
      $export->except(['approved', 'comments', 'attachment', 'otp']);
    });
    $grid->actions(function ($actions) {
      $actions->disableEdit();
      $actions->disableView();
      $actions->disableDelete();
      $actions->add(new ShowDocuments);
      if ($actions->row->approved == 0) {
        $actions->add(new Data);
        $actions->add(new Rejected);
      } else if ($actions->row->approved == 1) {
        //$actions->add(new Data);
        $actions->add(new Rejected);
      } else if ($actions->row->approved == 2) {
        $actions->add(new Data);
        //$actions->add(new Rejected);
      }
    });

    $grid->disableCreateButton();
    // $grid->column('id')->hidden();
  
    //$grid->model()->orderBy('created_at', 'desc');

    $grid->column('created_at', __('Created At'))->display(function ($value) {
      //return Carbon::parse($value)->format('d-m-Y H:i:s');
      return Carbon::parse($value)->format('Y-m-d H:i');
      //return Carbon::parse($value)->format('d-m-Y');
   });


   $grid->filter(function ($filter) {
    $filter->disableIdFilter();
    $filter->column(1 / 2, function ($filter) {
      //$filter->equal('name', __('Select Name'))->select(User::pluck('name', 'name')->toArray());
      $filter->like('name', __('First Name'));
      $filter->like('email', __('Email'));
    });
    $filter->column(1 / 2, function ($filter) {
      $filter->equal('approved', __('Status'))->select([
        0 => 'New',
        1 => 'Approved',
        2 => 'Rejected',
    ]);
      $filter->like('contact_number', __('Contact'));
    });
  });


   
   


   $grid->model()->whereHas('attachment', function ($query) {
      $query->whereNotNull('filename');
  })->orderByDesc('created_at');

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
    $show = new Show(User::findOrFail($id));
    // $show->field('id', __('Id'));
    $show->field('name', __('Name'));
    $show->field('last_name', __('Last name'));
    $show->field('email', __('Email'));
    $show->field('contact_number', __('Contact number'));

    return $show;
  }

  /**
   * Make a form builder.
   *
   * @return Form
   */
  protected function form()
  {
    // return $form;

    $form = new Form(new User());
    $form->text('name', __('First Name'))->rules('required|max:255|regex:/^[a-zA-Z]+$/');
    $form->text('last_name', __('Last name'))->rules('required|max:255|regex:/^[a-zA-Z]+$/');
    $form->email('email', __('Email'))->rules('required|max:255|email');
    $form->text('contact_number', __('Contact number'))->rules('required|max:10|unique:users|min:10');
    $form->footer(function ($footer) {
      $footer->disableViewCheck();

      // disable `Continue editing` checkbox
      $footer->disableEditingCheck();

      // disable `Continue Creating` checkbox
      $footer->disableCreatingCheck();

    });

    

    // $form->footer->class('form-footer'); 

    return $form;
  }


}