<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

        $grid->column('id', __('Id'));
        $grid->column('name', __('First Name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('email', __('Email'));
        $grid->column('contact_number', __('Contact number'));
        //$grid->column('email_verified_at', __('Email verified at'));
        //$grid->column('password', __('Password'));
        // $grid->column('otp', __('Otp'));
        // $grid->column('two_factor_secret', __('Two factor secret'));
        // $grid->column('otp_generated_at', __('Otp generated at'));
        // $grid->column('two_factor_recovery_codes', __('Two factor recovery codes'));
        // $grid->column('two_factor_confirmed_at', __('Two factor confirmed at'));
        // $grid->column('remember_token', __('Remember token'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('state', __('State'));

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

        $show->field('id', __('Id'));
        $show->field('name', __('First Name'));
        $show->field('last_name', __('Last name'));
        $show->field('email', __('Email'));
        $show->field('contact_number', __('Contact number'));
        $show->field('email_verified_at', __('Email verified at'));
        // $show->field('password', __('Password'));
        // $show->field('otp', __('Otp'));
        // $show->field('two_factor_secret', __('Two factor secret'));
        // $show->field('otp_generated_at', __('Otp generated at'));
        // $show->field('two_factor_recovery_codes', __('Two factor recovery codes'));
        // $show->field('two_factor_confirmed_at', __('Two factor confirmed at'));
        // $show->field('remember_token', __('Remember token'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));
        // $show->field('state', __('State'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->text('last_name', __('Last name'));
        $form->email('email', __('Email'));
        $form->text('contact_number', __('Contact number'));
        //$form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        // $form->textarea('otp', __('Otp'));
        // $form->textarea('two_factor_secret', __('Two factor secret'));
        // $form->datetime('otp_generated_at', __('Otp generated at'))->default(date('Y-m-d H:i:s'));
        // $form->textarea('two_factor_recovery_codes', __('Two factor recovery codes'));
        // $form->datetime('two_factor_confirmed_at', __('Two factor confirmed at'))->default(date('Y-m-d H:i:s'));
        // $form->text('remember_token', __('Remember token'));
        // $form->number('state', __('State'));

        return $form;
    }
}
