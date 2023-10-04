<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\verification;
use App\Models\AdminUser;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Carbon;

class adminAuthController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AdminUser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AdminUser());

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'))->display(function ($value) {
            if ($value === null) {
                return "N/A";
            } else {
                return $value;
            }

        });


        $grid->column('is_verified', __('Status'))->display(function ($value) {
            if ($value == 0) {
                return "<span style='background-color:red;color:#fff;padding:3px 10px;border-radius:10px'>Not verified</span>";
            } else {
                return "<span style='background-color:green;color:#fff;padding:3px 10px;border-radius:10px'>Verified</span>";
            }
        });

        $grid->column('Roles', __('Role'))->display(function ($value) {
            if ($value == null) {
                return "N/A";
            } else {
                foreach ($value as $key => $singlevalue) {

                    $arr[] = $singlevalue['name'];
                }

                return implode(",", $arr);
            }
        });


        $grid->column('created_at', __('Created At'))->display(function ($value) {

            return Carbon::parse($value)->format('Y-m-d H:i');
        });

        $grid->disableCreateButton();
        $grid->actions(function ($action) {
            $action->disableDelete();
            $action->disableView();
            $action->disableEdit();
            if ($action->row->is_verified == 0) {

                $action->add(new Verification());
            } else {

            }

        });

        $html = <<<HTML
          <style>

              .emailverification
              {
               display:inline-block!important;
               width:50%;
               padding: 6px 12px;
                 border: 1px solid #d2d6de;

              }
              .emailverification:focus-visible
              {
                  outline:1px solid #3c8dbc!important;
                  border-color:none!important;
              }
              #emaillabel
              {
                  display: block!important;
              }
              #verifiction_head label
               {
                display: block!important;

              }
              #verifiction_head input
              {
                  padding:6px 12px;
                  border:1px solid #d2d6de;
                  width:50%;
              }
              #verifiction_head input:focus-visible
              {
                  outline:1px solid #3c8dbc!important;
                  border-color:none!important;
              }

          </style>


        HTML;
        Admin::html($html);

        $jsFilePath = public_path('js/emailverification.js');
        $jsContent = file_get_contents($jsFilePath);
        Admin::script($jsContent);
        $grid->filter(function ($filter) {
            $filter->like('username', 'Username');
            $filter->like('name', 'Name');
            $filter->like('email', 'Email');
            $filter->like('roles.name', 'Role');
            $filter->disableIdFilter();
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
        $show = new Show(AdminUser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('name', __('Name'));
        $show->field('otp', __('Otp'));
        $show->field('email', __('Email'));
        $show->field('avatar', __('Avatar'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AdminUser());

        $form->text('username', __('Username'));
        $form->password('password', __('Password'));
        $form->text('name', __('Name'));
        $form->text('otp', __('Otp'));
        $form->email('email', __('Email'));
        $form->image('avatar', __('Avatar'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}