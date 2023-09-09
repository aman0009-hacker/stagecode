<?php

// namespace App\Admin\Controllers;

// use App\Http\Controllers\Controller;
// use Encore\Admin\Controllers\Dashboard;
// use Encore\Admin\Layout\Column;
// use Encore\Admin\Layout\Content;
// use Encore\Admin\Layout\Row;
// use Encore\Admin\Widgets\Form;
// use Encore\Admin\Widgets\Box;
// use Encore\Admin\Widgets\InfoBox;

// class HomeController extends Controller
// {
//     public function index(Content $content)
//     {

//         return $content
//             ->title('Dashboard')
//             ->description('Admin Portal')
//             // ->row(Dashboard::title())
//             ->row(function (Row $row) {
//                 $row->class('justify-content-center align-items-center h-50 graphcss');
//                 $row->column(4, function (Column $column) {
//                     $column->append(new Box('Users Records', view('admin.charts.barChart')));
//                 });
//                 $row->column(4, function (Column $column) {
//                     $column->append(new Box('Users Count Records ', view('admin.charts.donutChart')));
//                 });
//                 $row->column(4, function (Column $column) {
//                     $column->append(new Box('Order Count Records', view('admin.charts.pieChart')));
//                 });
//             })
//             ->row(function (Row $row) {
//                 $row->class('justify-content-center align-items-center h-50');
//                 $row->column(7, function (Column $column) {
//                     $column->append(new Box('Order Amount Records', view('admin.charts.waveChart')));
//                 });
//                 $row->column(5, function (Column $column) {
//                     $column->append(new Box('Yard Records', view('admin.charts.lineChart')));
//                 });

//             });

//     }
// }

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Admin Portal')
            ->row(function (Row $row){
                $row->class('justify-content-center align-items-center');
                // $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/auth/user', '1024');

                // $row->column(4, function (Column $column) use ($infoBox) {
                //     $column->append($infoBox->render());
                // });
                $row->column(6, function (Column $column) {
                    $column->append(new Box('', view('admin.admin-users-notification'))); //users notification blade file
                });
                $row->column(6, function (Column $column) {
                    $column->append(new Box('', view('admin.admin-orders-notification'))); //order notification blade file
                });
                // $row->column(4, function (Column $column) {
                //     $column->append(new Box('', view('admin.admin-yards-notification'))); //yards record notificatin blade file
                // });
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

