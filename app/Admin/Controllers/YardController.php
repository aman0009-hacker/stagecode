<?php

namespace App\Admin\Controllers;

use App\Models\State;
use App\Models\Yard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
// use App\Models\Yard;
use App\Models\AdminUser;
use App\Models\Role;
use App\Models\RoleUser;

class YardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Yard';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Yard());
        // $grid->model()->groupBy('yards.yardstate, yards.yardcity, yards.yardplace, COUNT(*)');
        // $grid->column('id', __('Id'));   
        $grid->column('yardcountry', __('Country'));
        $grid->column('yardstate', __('State'));
        $grid->column('yardcity', __('City'));
        $grid->column('yardplace', __('Place'));
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('yardcountry', __('Country'));
                $filter->like('yardcity', __('City'));
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->like('yardstate', __('State'));
                $filter->like('yardplace', __('Place'));
            });
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
        $show = new Show(Yard::findOrFail($id));
        // $show->field('id', __('Id'));
        $show->field('yardcountry', __('Yardcountry'));
        $show->field('yardstate', __('Yardstate'));
        $show->field('yardcity', __('Yardcity'));
        $show->field('yardplace', __('Yardplace'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Yard());
        $form->text('yardcountry', __('Country'))->default('India')->rules('required');
        // $form->select('yardstate', __('State'))->options(State::all()->pluck('name', 'name'))->load('yardcity', '/admin/get-cities')->rules('required');
        // $form->select('yardstate', __('State'))->options(['Punjab' => 'Punjab'])->default('Punjab')->load('yardcity', '/admin/get-cities')->rules('required');
        $form->select('yardstate', __('State'))->options(['' => 'Select State', 'Punjab' => 'Punjab'])
            ->default('')
            ->load('yardcity', '/admin/get-cities')
            ->rules('required');
        // $form->select('yardcity', __('City'))->rules('required');
        // $form->text('yardcountry', __('Country'))->default('India')->rules('required');
        $form->select('yardcity', __('City'))->rules('required');
        $form->text('yardplace', __('Place'))->rules('required');
        // $supervisors = AdminUser::whereHas('roles', function ($query) {
        //     $query->where('name', 'YardCreator');
        // })->pluck('username', 'id');
        // $form->select('supervisorid', "__Supervisor UserName")->options($supervisors);
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }


}