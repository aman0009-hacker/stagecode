<?php

<<<<<<< HEAD

=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;


class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Admin Portal')
            ->row(function (Row $row) {
                $row->class('justify-content-center align-items-center');
                $row->column(6, function (Column $column) {
                    $column->append(new Box('', view('admin.admin-users-notification'))); //users notification blade file
                });
                $row->column(6, function (Column $column) {
                    $column->append(new Box('', view('admin.admin-orders-notification'))); //order notification blade file
                });
            })
            ->row(function (Row $row) {
                $row->class('justify-content-center align-items-center h-50 graphcss');

                // Add your InfoBox here


                $row->column(4, function (Column $column) {
                    $column->append(new Box('Users Records', view('admin.charts.barChart')));
                });
                $row->column(4, function (Column $column) {
                    $column->append(new Box('Users Count Records ', view('admin.charts.donutChart')));
                });
                $row->column(4, function (Column $column) {
                    $column->append(new Box('Order Count Records', view('admin.charts.pieChart')));
                });
            })
            ->row(function (Row $row) {
                $row->class('justify-content-center align-items-center h-50');
                $row->column(7, function (Column $column) {
                    $column->append(new Box('Order Amount Records', view('admin.charts.waveChart')));
                });
                $row->column(5, function (Column $column) {
                    $column->append(new Box('Yard Records', view('admin.charts.lineChart')));
                });
            });
    }
}