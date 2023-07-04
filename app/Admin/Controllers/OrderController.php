<?php

namespace App\Admin\Controllers;


use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;
use App\Models\OrderItem;
use App\Admin\Actions\OrderRejected;
use Encore\Admin\Show;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Admin\Actions\OrderDispatched;
use App\Admin\Actions\OrderPayment;
use App\Admin\Actions\OrderApproved;
use Illuminate\Support\Facades\Log;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        try {
            $grid = new Grid(new Order());
            // $grid->column('id', __('Id'));
            // $grid->column('amount', __('Amount'));
            // $grid->column('transaction_date', __('Transaction date'));
            // $grid->column('transaction_id', __('Transaction id'));
            // $grid->column('person', __('Person'));
            // $grid->column('category_name', __('Category name'));
            // $grid->column('description', __('Description'));
            // $grid->column('diameter', __('Diameter'));
            // $grid->column('size', __('Size'));
            // $grid->column('quantity', __('Quantity'));
            // $grid->column('measurement', __('Measurement'));
            $grid->column('user_id', __('User'))->display(function ($user_id) {
                return User::find($user_id)->name;
            });
            $grid->column('id', __('Order Items'))->display(function ($id) {
                //$count = count($comments);
                //return "<span class='label label-warning'>{$count}</span>";
                return "items ( " . OrderItem::where('order_id', $id)->count() . " )";
            })->expand(function ($model) {
                $orderId = $model->id;
                $orderItems = OrderItem::where('order_id', $orderId)->get();
                $tableData = $orderItems->map(function ($item) {
                    return [
                        'Item' => $item->category_name,
                        'Description' => $item->description,
                        'Diameter' => $item->diameter,
                        'Size' => $item->size,
                        'Quantity' => $item->quantity,
                        'Measurement (Ton) ' => $item->measurement,
                    ];
                });
                return new Table(['Item', 'Description', 'Diameter', 'Size', 'Quantity', 'Measurement'], $tableData->toArray());
            });
            // $grid->column('user_id', __('User'))->display(function($user_id)
            // {
            // });
            $grid->column('status', __('Status'));
            // $grid->column('firm', __('Firm'));
            $grid->column('created_at', __('Created at'))->display(function ($value) {
                //  return Carbon::parse($value)->format('Y-m-d H:i:s');
                //   return Carbon::parse($value)->format('d-m-Y');
                return Carbon::parse($value)->format('Y-m-d H:i');
            });
            // $grid->column('updated_at', __('Updated at'));
            // $grid->actions(function ($actions) {
            //     $actions->add(new OrderApproved);
            //     $actions->add(new OrderDispatched);
            //     $actions->add(new OrderRejected);
            //     // if ($actions->row->approved == 0) {
            //     //   $actions->add(new Data);
            //     //   $actions->add(new Rejected);
            //     // } else if ($actions->row->approved == 1) {
            //     //   //$actions->add(new Data);
            //     //   $actions->add(new Rejected);
            //     // } else if ($actions->row->approved == 2) {
            //     //   $actions->add(new Data);
            //     //   //$actions->add(new Rejected);
            //     // }
            // });
            $grid->actions(function ($actions) {
                $actions->disableEdit();
                $actions->disableView();
                $actions->disableDelete();
                if ($actions->row->status == "Approved") {
                    $actions->add(new OrderDispatched);
                    $actions->add(new OrderRejected);
                    $actions->add(new OrderPayment);
                } else if ($actions->row->status == "Rejected") {
                    $actions->add(new OrderApproved);
                    $actions->add(new OrderDispatched);
                    $actions->add(new OrderPayment);
                } else if ($actions->row->status == "Dispatched") {
                    $actions->add(new OrderApproved);
                    $actions->add(new OrderRejected);
                    $actions->add(new OrderPayment);
                } else if ($actions->row->status == "New") {
                    $actions->add(new OrderApproved);
                    $actions->add(new OrderDispatched);
                    $actions->add(new OrderRejected);
                    $actions->add(new OrderPayment);
                } else if ($actions->row->status == "Payment_Done") {
                    $actions->add(new OrderApproved);
                    $actions->add(new OrderDispatched);
                    $actions->add(new OrderRejected);
                }
            });
            $grid->filter(function ($filter) {
                // $filter->notIn('id', __('Id'));
                $filter->disableIdFilter();
                $filter->column(1 / 2, function ($filter) {
                    $userIds = Order::pluck('user_id')->toArray();
                    $userNames = User::whereIn('id', $userIds)->pluck('name', 'id')->toArray();
                    $filter->equal('user_id', __('User'))->select($userNames);
                    //$filter->equal('user_id', __('User'))->select(User::pluck('name', 'id')->toArray());
                });
                $filter->column(1 / 2, function ($filter) {
                    $filter->like('status', __('Status'));
                });
            });
            $grid->export(function ($export) {
                //$export->filename('Filename.csv');
                $export->except(['id']);
            });
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->model()->orderBy('created_at', 'desc');
            return $grid;
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
            return $grid;
        }
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));
        // $show->field('id', __('Id'));
        // $show->field('amount', __('Amount'));
        // $show->field('transaction_date', __('Transaction date'));
        // $show->field('transaction_id', __('Transaction id'));
        // $show->field('status', __('Status'));
        // $show->field('person', __('Person'));
        // $show->field('category_name', __('Category name'));
        // $show->field('description', __('Description'));
        // $show->field('diameter', __('Diameter'));
        // $show->field('size', __('Size'));
        // $show->field('quantity', __('Quantity'));
        // $show->field('measurement', __('Measurement'));
        // $show->field('user_id', __('User id'));
        // $show->field('firm', __('Firm'));
        $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());
        // $form->decimal('amount', __('Amount'));
        // $form->date('transaction_date', __('Transaction date'))->default(date('Y-m-d'));
        // $form->number('transaction_id', __('Transaction id'));
        // $form->text('status', __('Status'));
        // $form->text('person', __('Person'));
        // $form->text('category_name', __('Category name'));
        // $form->text('description', __('Description'));
        // $form->text('diameter', __('Diameter'));
        // $form->text('size', __('Size'));
        // $form->text('quantity', __('Quantity'));
        // $form->text('measurement', __('Measurement'));
        // $form->text('user_id', __('User id'));
        // $form->text('firm', __('Firm'));
        return $form;
    }
}