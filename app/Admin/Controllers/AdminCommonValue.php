<?php

namespace App\Admin\Controllers;

use App\Models\adminCommonValueChange;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminCommonValue extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Changes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new adminCommonValueChange());

        $grid->column('id', __('Id'));
        $grid->column('yard_record_value', __('Yard record value'));
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->disableRowSelector();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
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
        $show = new Show(adminCommonValueChange::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('yard_record_value', __('Yard record value'));
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
        $form = new Form(new adminCommonValueChange());

        $form->text('yard_record_value', __('Yard record value'));

        return $form;
    }
}