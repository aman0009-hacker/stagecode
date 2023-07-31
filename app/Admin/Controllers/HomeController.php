<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Box;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Admin Portal')
            // ->row(Dashboard::title())
            ->row(function (Row $row) {
                $row->class('justify-content-center align-items-center h-50');
                $row->column(4, function (Column $column) {
                    $column->append(new Box('Users Records', view('admin.charts.barChart')));
                });
                $row->column(4, function (Column $column) {
                    $column->append(new Box('Users Count Records ', view('admin.charts.donutChart')));
                });
                $row->column(4, function (Column $column) {
                    $column->append(new Box('Yard Records', view('admin.charts.lineChart')));
                });
                $row->column(7, function (Column $column) {
                    $column->append(new Box('Order Amount Records', view('admin.charts.waveChart')));
                });
             
                $row->column(5, function (Column $column) {
                    $column->append(new Box('Order Count Records', view('admin.charts.pieChart')));
                });


            });

    }
}