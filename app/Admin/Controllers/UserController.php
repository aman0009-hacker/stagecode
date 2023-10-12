<?php

namespace App\Admin\Controllers;


use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use App\Admin\Actions\Rejected;
use App\Admin\Actions\Data;
use App\Admin\Actions\ShowDocuments;
use Encore\Admin\Facades\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentDataHandling;
use App\Admin\Actions\RegisterWithPsiec;
use App\Models\Order;
use App\Models\Invoice;

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
    try {
      $grid = new Grid(new User());


      $grid->column('name', __('First Name'));

      $grid->column('last_name', __('Last Name'));
      $grid->column('email', __('Email'));
      $grid->column('contact_number', __('Contact Number'));
      $grid->column('attachment', 'Info')->display(function ($comments) {

        return "documents";
      })->expand(function ($model) {
        $comments = $model->attachment()->take(10)->where('fileno', 'IS NOT', null)->get()->map(function ($comment) {
          return $comment->only(['file_type', 'fileno', 'created_at']);
        });
        return new Table(['Document Type', 'Document No', 'Release Time'], $comments->toArray());
      });
      $grid->column("approved", __('Status'))->display(function ($value) {
        if (isset($value) && $value === 1) {
          return "Approved";
        } else if (isset($value) && $value === 0) {
          return "New";
        } else if (isset($value) && $value === 2) {
          return "Rejected";
        }
      });


      $grid->export(function ($export) {

        $export->except(['approved', 'comments', 'attachment', 'otp', 'Wallet']);
      });
      $grid->actions(function ($actions) {
        if (Admin::user()->inRoles(['admin', 'administrator', 'Administartor'])) {

        } else if (Admin::user()->inRoles(['superadmin', 'SuperAdmin'])) {
        }
        $actions->disableView();
        $actions->disableDelete();
        $actions->disableEdit();

        $data=admin::user();

        // dd($data);


        $actions->add(new ShowDocuments);
<<<<<<< HEAD
        if($data->inRoles(['administrator']))
        {

          if ($actions->row->approved == 0) {
            $actions->add(new Data);
            $actions->add(new Rejected);
          } else if ($actions->row->approved == 1) {
            //$actions->add(new Data);
            $actions->add(new Rejected);
          } else if ($actions->row->approved == 2) {
            $actions->add(new Data);

          }
          $actions->add(new RegisterWithPsiec);
=======
        if ($actions->row->approved == 0) {
          $actions->add(new Data);
          $actions->add(new Rejected);
        } else if ($actions->row->approved == 1) {
          //$actions->add(new Data);
          $actions->add(new Rejected);
        } else if ($actions->row->approved == 2) {
          $actions->add(new Data);

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        }
      });

      $grid->batchActions(function ($batchActions) {
        $batchActions->disableDelete(); // Disable batch delete for all cases
      });
      $grid->disableCreateButton();

      $grid->column('created_at', __('Created At'))->display(function ($value) {

        return Carbon::parse($value)->format('Y-m-d');

      });
      $grid->model()->orderBy('created_at', 'desc');



      $grid->column('Wallet')->display(function () {
        return "Balance";
      })->expand(function ($model) {
        $user_id = $this->getkey();
        $date = Carbon::now();
        $allorders = Order::where('user_id', $user_id)->get();
        $orderDetails = [];
        $orderDetails2 = [];
        if (isset($allorders) && !empty($allorders)) {
          foreach ($allorders as $order) {
            $orderData = [
              "Order No" => "(N/A)",
              "Balance On Booking" => "(N/A)",
              "Booking Transaction ID" => "(N/A)",
              "Booking Amount" => "<span style='color:red;font-weight:600'>(Unpaid)</span>",
              "Final Transaction ID" => "(N/A)",
              "Final Amount" => "<span style='color:red;font-weight:600'>(Unpaid)</span>",
              "Final Payment Mode" => "<span style='color:black;font-weight:600'>(N/A)</span>",
              "Cheque Info" => "<span style='color:black;font-weight:600'>(N/A)</span>",
            ];

            if (isset($order->id) && !empty($order->id)) {
              $order_id = $order->order_no;
              if (isset($order_id) && !empty($order_id)) {
                $orderData["Order No"] = $order_id;
              } else {
                $orderData["Order No"] = "(N/A)";
              }

              $balance_on_booking = Order::where('id', $order->id)->where('user_id', $user_id)->value('balance_on_booking');
              if (isset($balance_on_booking) && !empty($balance_on_booking)) {
                $orderData['Balance On Booking'] = $balance_on_booking;
              } else {
                $orderData['Balance On Booking'] = "(N/A)";
              }


              $final_transaction = PaymentDataHandling::where('order_id', $order->id)->where('user_id', $user_id)->where('data', 'Booking_Final_Amount')->pluck('transaction_id')->last();

              $invalid_cheque_transaction = PaymentDataHandling::where('order_id', $order->id)->where('user_id', $user_id)->where('data', 'Invalid_Cheque_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->pluck('transaction_id')->last();

              if (isset($final_transaction) && !empty($final_transaction)) {
                $orderData["Final Transaction ID"] = $final_transaction;
              } elseif (isset($invalid_cheque_transaction) && !empty($invalid_cheque_transaction)) {
                $orderData["Final Transaction ID"] = $invalid_cheque_transaction;
              } else {
                $orderData["Final Transaction ID"] = "(N/A)";
              }



              $booking_transaction = PaymentDataHandling::where('order_id', $order->id)->where('user_id', $user_id)->where('data', 'Booking_Amount')->pluck('transaction_id')->last();
              if (isset($booking_transaction) && !empty($booking_transaction)) {
                $orderData["Booking Transaction ID"] = $booking_transaction;
              } else {
                $orderData["Booking Transaction ID"] = "(N/A)";

              }
              $initial_amount = PaymentDataHandling::where('order_id', $order->id)->where('user_id', $user_id)->where('data', 'Booking_Amount')->get()->last();
              if (isset($initial_amount) && !empty($initial_amount) && isset($initial_amount->transaction_amount) && !empty($initial_amount->transaction_amount)) {
                $orderData['Booking Amount'] = $initial_amount->transaction_amount;
              } else {
                $orderData['Booking Amount'] = "<span style='color:red;font-weight:600'>(Unpaid)</span>";
              }

              $final_amount = PaymentDataHandling::where('order_id', $order->id)->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->where('user_id', $user_id)->where('data', 'Booking_Final_Amount')->get()->last();
              $invalid_cheque_amount = PaymentDataHandling::where('order_id', $order->id)
                ->where('user_id', $user_id)
                ->where('data', 'Invalid_Cheque_Amount')
                ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                ->get()
                ->last();

              if (isset($final_amount) && !empty($final_amount) && isset($final_amount->payment_status) && !empty($final_amount->payment_status)) {
                if (strtolower($final_amount->payment_status) === strtolower('success') || strtolower($final_amount->payment_status) === strtolower('rip') || strtolower(strtolower($final_amount->payment_status)) === strtolower('sip')) {
                  $totalAmount = $final_amount->transaction_amount;

                  //find tax
                  $invoice = Invoice::where('order_id', $order->id)->orderBy('created_at', 'desc')->first();
                  //find tax
                  if (isset($invoice) && isset($invoice->amount) && isset($invoice->totaltax)) {
                    $orderData['Final Amount'] = $totalAmount . " (Amount: {$invoice->amount}, Tax: {$invoice->totaltax})";
                  } else {
                    $orderData['Final Amount'] = $totalAmount;
                  }

                } else {
                  $orderData['Final Amount'] = "<span style='color:red;font-weight:600'>(Unpaid)</span>";
                }
              } elseif (isset($invalid_cheque_amount) && !empty($invalid_cheque_amount)) {

                $totalAmount = $invalid_cheque_amount->transaction_amount;
                $invoice = Invoice::where('order_id', $order->id)->orderBy('created_at', 'desc')->first();
                $interestAmount = Order::where('id', $order->id)->where('user_id', $user_id)->value('interest_amount');
                $interestAmountRound = round($interestAmount, 2);
                if (isset($invoice) && isset($invoice->amount)) {

                  $orderData['Final Amount'] = $totalAmount . " (Amount: {$invoice->amount}, Tax: {$invoice->totaltax}, Interest: {$interestAmountRound})";

                } else {
                  $orderData['Final Amount'] = $totalAmount . " <span style='color:green;font-weight:600'></span>";
                }
              } elseif (isset($balance_on_booking) && !empty($balance_on_booking)) {
                $invoice = Invoice::where('order_id', $order->id)->orderBy('created_at', 'desc')->first();

                $totalAmount = $invoice->amount + $invoice->totaltax;

                if (isset($invoice) && isset($invoice->amount)) {
                  $orderData['Final Amount'] = $totalAmount . " (Amount: {$invoice->amount}, Tax: {$invoice->totaltax})";
                } else {
                  $orderData['Final Amount'] = $totalAmount . " <span style='color:green;font-weight:600'></span>";
                }
              } else {
                $final_check_amount = Order::where('user_id', $user_id)->where('id', $order->id)->where('payment_mode', 'cheque')->get()->last();

                if (
                  isset($final_check_amount) &&
                  !empty($final_check_amount) &&
                  isset($final_check_amount->final_payment_status) &&
                  !empty($final_check_amount->final_payment_status) &&
                  $final_check_amount->final_payment_status === 'verified'
                ) {
                  $orderData['Final Amount'] = "<span style='color:green;font-weight:600'>(Paid With Cheque)</span>";
                } else {
                  $orderData['Final Amount'] = "<span style='color:red;font-weight:600'>(Unpaid)</span>";
                }
              }

              $paymentMode = $order->payment_mode;
              if (isset($paymentMode) && !empty($paymentMode)) {
                $orderData['Final Payment Mode'] = $paymentMode;
              } else {
                $orderData['Final Payment Mode'] = "<span style='color:red;font-weight:600'>(N/A)</span>";
              }

              if ($order->payment_mode === 'cheque') {
                if ($order->cheque_final_amount != null || $order->final_amount != "") {
                  $chequeDate = $order->Cheque_Date ?? '';
                  $chequeAmount = $order->check_amount ?? '';
                  $chequeNumber = $order->cheque_number ?? '';
                  $finalAmount = $order->cheque_final_amount ?? '';
                  $checkcompletionDate = Carbon::parse($order->cheque_arrival_date ?? '')->format("m/d/Y");
                  $orderData['Cheque Info'] = "[Cheque Date: " . $checkcompletionDate . "]" . " " . "[Cheque Number: " . $chequeNumber . "]" . "  " . " [Final Cheque Amount: " . $finalAmount . "]";
                } else {

                  $chequeDate = '';
                  if ($order->Cheque_Date) {
                    $chequeDate = Carbon::parse($order->Cheque_Date)->format("m/d/Y");
                  }
                  $chequeAmount = $order->check_amount ?? '';
                  $chequeNumber = $order->cheque_number ?? '';
                  $orderData['Cheque Info'] = "[Cheque Date: " . $chequeDate . "]" . " " . "[Cheque Number: " . $chequeNumber . "]" . "  " . " [Cheque Amount: " . $chequeAmount . "]";
                }
              } else {
                $orderData['Cheque Info'] = "<span style='color:black;font-weight:600'>(N/A)</span>";
              }
            }

            // Add order data to the array
            $orderDetails[] = $orderData;
          }
        }
        $payment = PaymentDataHandling::where('user_id', $this->getKey())->where('data', 'Registration_Amount')->whereIn('payment_status', ['RIP', 'SUCCESS', 'SIP'])->get();



        foreach ($payment as $singlepayment) {
          $registration = [
            "transaction_id" => "(N/A)",
            "registration_amount" => "(N/A)",
            "status" => "(N/A)",
            "date" => "(N/A)"
          ];
          if (isset($singlepayment->transaction_id) && !empty($singlepayment->transaction_id)) {

            $registration["transaction_id"] = $singlepayment->transaction_id;
          } else {
            $registration["transaction_id"] = "<span style='color:red;font-weight:600'>(N/A)</span>";
          }

          if (isset($singlepayment->transaction_amount) && !empty($singlepayment->transaction_amount)) {
            $registration["registration_amount"] = $singlepayment->transaction_amount . "<span style='color:green;font-weight:600'>(Paid)</span>";

          } else {
            $registration["registration_amount"] = "<span style='color:red;font-weight:600'>(N/A)</span>";
          }


          if (isset($singlepayment->payment_status) && !empty($singlepayment->payment_status)) {
            $registration["status"] = "SUCCESS";

          } else {
            $registration["status"] = "<span style='color:red;font-weight:600'>" . $singlepayment->payment_status . "</span>";
          }
          $registration["date"] = $singlepayment->transaction_date;



          $orderDetails2[] = $registration;

        }


        // Define the column headers explicitly
        $headers = ['Order No', 'Balance on Booking', 'Booking Transaction ID', 'Booking Amount', 'Final Transaction ID', 'Final Amount', ' Final Payment Mode', 'Cheque Info'];

        $headers2 = ['Transaction Id', 'Registration Amount', 'Status', 'Date'];
        $table2 = new Table($headers2, $orderDetails2);
        $table1 = new Table($headers, $orderDetails);
        $html1 = $table1->render();
        $html2 = $table2->render();
        // Return the Table instance with all order data and headers
        return $html2 . '<br><br>' . $html1;
      });


      $grid->column('comment', __('Payment'))->display(function ($value) {
        if (isset($value) && !empty($value) && $value == "Done") {
          return "Done" . "  [₹ 10000]";
        } else {
          return "Pending";
        }
      });
      $grid->column("member_at", __("Register Since"))->display(function ($value) {
        if (isset($value) && !empty($value)) {
          return Carbon::parse($value)->format('Y-m-d');
        } else {
          $userID = $this->id;
          if (isset($userID) && !empty($userID)) {
            $user = User::with([
              'paymentDataHandling' => function ($query) {
                $query->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                  ->where("data", "Registration_Amount")
                  ->orderBy('updated_at', 'desc')
                  ->limit(1);
              }
            ])->find($userID);
            //return $user;
            if ($user) {
              if ($user->paymentDataHandling->isNotEmpty()) {
                $updatedAt = $user->paymentDataHandling->first()->updated_at;
                //return $updatedAt;
                $customerStartDate = Carbon::parse($updatedAt);
                //insert member at in DB
                return Carbon::parse($customerStartDate)->format('Y-m-d');
              } else {
                return "N/A";
              }
            } else {
              return "N/A";
            }
          } else {
            return "N/A";
          }
        }
      });



      $grid->filter(function ($filter) {
        $filter->disableIdFilter();
        $filter->column(1 / 2, function ($filter) {

          $filter->like('name', __('First Name'));
          $filter->like('email', __('Email'));
        });
        $filter->column(1 / 2, function ($filter) {
          $filter->equal('approved', __('Status'))->select([
            0 => 'New',
            1 => 'Approved',
            2 => 'Rejected',
          ]);
          $filter->like('contact_number', __('Contact'));
        });
      });
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
    $show = new Show(User::findOrFail($id));

    $show->field('name', __('Name'));
    $show->field('last_name', __('Last name'));
    $show->field('email', __('Email'));
    $show->field('contact_number', __('Contact number'));
    return $show;
  }

  /**
   * Make a form builder.
   *
   * @return Form
   */
  protected function form()
  {
    // return $form;
    $form = new Form(new User());

    $form->date("member_at", __("Register with PSIEC"));
    $form->footer(function ($footer) {
      $footer->disableViewCheck();
      // disable `Continue editing` checkbox
      $footer->disableEditingCheck();
      // disable `Continue Creating` checkbox
      $footer->disableCreatingCheck();
    });

    return $form;
  }
}