<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Form;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Admin Portal')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });


        // $form = new Form();

        // $form->action('example');

        // $form->email('email')->default('qwe@aweq.com');
        // $form->password('password');
        // $form->text('name');
        // $form->url('url');
        // $form->color('color');
        // $form->map('lat', 'lng');
        // $form->date('date');
        // $form->json('val');
        // $form->dateRange('created_at', 'updated_at');

        // echo $form->render();
    }
}