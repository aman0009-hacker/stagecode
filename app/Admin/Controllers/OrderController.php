<?php

namespace App\Admin\Controllers;


use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;
use App\Models\OrderItem;
use App\Admin\Actions\OrderRejected;
use Encore\Admin\Show;
use App\Models\PaymentDataHandling;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Admin\Actions\OrderDispatched;
use App\Admin\Actions\OrderPayment;
use App\Admin\Actions\OrderApproved;
use Illuminate\Support\Facades\Log;
use Encore\Admin\Facades\Admin;

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
            $csrfToken = csrf_token();
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
            // $grid->column('payment_mode', __('Payment Mode'));

            $grid->column('payment_mode', __('Payment Mode'))->display(function ($title) {
                $id = $this->id;
                if ($title == "cheque") {
                    //return "<a style='color:#fff' class='btn btn-primary' onclick='fun($id)'>$title</a>";
                    return "<a style='color:#fff' class='btn btn-primary allbtn' id=$id>$title</a>";
                } else {
                    return "<a style='color:#fff' class='btn btn-primary'>$title</a>";
                }
            });

            $grid->column('payment_status', __('Booking Amount'))->display(function ($value) {
                if ($value == "verified") {
                    $value = PaymentDataHandling::where('order_id', $this->id)->where('data', "Booking_Amount")->orderBy('created_at', 'desc')->first();
                    return $value->transaction_amount ?? "Done";
                } else {
                    return "Pending";
                }
            });
            $grid->column('final_payment_status', __('Final Payment'))->display(function ($value) {
                if ($value == "verified") {
                    return "Done";
                } else {
                   return "Pending";
                }
            });
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

            $htmls = <<<HTML
            <head>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <script src="../../js/modal.js"></script>
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
         
       
            <style>
            input[type=file] {
                  margin-bottom: 20px;
            }
           .fileadding
               {
                display: inline-flex;
                flex-direction: column;
               }
            span.btn.btn-success {
                  padding: 0px;
                  height: 27px;
                  width: 80px;
                  margin-right:10px;
              }
              span.btn.btn-danger
              {
                padding: 0px;
                  height: 27px;
                  width: 100px;
              }
              svg {
                      border-right: 1px solid #fff;
                      width: 25px;
                  }
                span.name {
                  vertical-align: 6px;
                  padding: 0px 7px;
                  font-size: 16px;
              }
            </style>
            </head>
             <section>
                  <div class="modal fade" id="openthemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div div class="modal-dialog" role="document">
                    <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"style="font-size: 20px;">Cheque Deposit Form</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                       <form method="post" action="/payment/process/verify/extra/js" enctype="multipart/form-data" id="OrderForm">
                          <input type="hidden" name="_token" value="{$csrfToken}"> 
                          <input type="hidden" id="modalIdInput" name="modalId">
                                     <label for="file">Upload File</label >
                                            <div id="allfiles" class="fileadding">
                                      <input type="file" name="files[]" class="allitems" required >
                                            </div>
                                      <!-- icon -->
                                               <span class="btn btn-success" onclick="let image=imagesAdd()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="rgba(255,255,255,1)"></path></svg><span class="name">Add</span></span>
                                               <span class="btn btn-danger" onclick="imagesRemove()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 11H5V13H19V11Z" fill="rgba(255,255,255,1)"></path></svg><span class="name">Remove</span></span>
                                            <!--  -->
                                         <div class="amount_coloumn"style="margin-top:20px">
                                                        <label for="Amount" class="form-label">Amount</label>
                                                        <input type="number" class="form-control" id="Amount" name="amount" placeholder="Enter Amount" required>
                                                    </div>
                                                    <div class="chequecoloumn"style="margin-top:20px" >
                                                        <label for="Cheque" class="form-label">Cheque</label>
                                                        <input type="text" class="form-control" id="Cheque" name="cheque" placeholder="Enter Cheque Number"required>
                                                    </div>
                                      <div class="row">
                                         <hr>
                                      </div>      
                              <div class="action"style="margin-top:-3px">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary"style="float:right">Submit</button>
                                                </div>
                          </form>
                </div>
              </div>
            </div>
                  </div>
                  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
         </section> 
         HTML;
            Admin::html($htmls);

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