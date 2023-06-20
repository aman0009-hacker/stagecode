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
                $row->class('justify-content-center align-items-center h-100');
                $row->column(3, function (Column $column) {
                    $column->append(new Box('User Document Verification (BAR)', view('admin.chartjs')));
                });
                $row->column(3, function (Column $column) {
                    $column->append(new Box('User Document Verification (PIE)', view('admin.chartjspie')));
                });
                $row->column(3, function (Column $column) {
                    $column->append(new Box('User Document Verification (LINE)', view('admin.chartjsline')));
                });
                $row->column(3, function (Column $column) {
                    $column->append(new Box('User Document Verification (DOUGHNUT)', view('admin.chartjsscatter')));
                });
            });
    }
}