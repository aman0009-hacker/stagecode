<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Records;
use App\Models\Entity;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Models\UserPayment;
use Encore\Admin\Layout\Content;

use Illuminate\Support\Facades\Auth;


class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $categoryList = Category::pluck('name', 'id');

            if ($categoryList->isNotEmpty()) {
                return view('components.category', compact('categoryList'));
            } else {
                return view('components.category')->withInput();
            }
        } catch (\Exception $ex) {
            return view('components.category');
        }
    }

    public function entity(Request $request, $categoryId)
    {
        try {
            $categoryValue = $categoryId;

            if (isset($categoryValue) && !empty($categoryValue)) {
                $entityList = Entity::where("entity_id", $categoryValue)->distinct('name')->pluck('name');
                if ($entityList->isNotEmpty()) {
                    return response()->json($entityList);
                } else {
                    // return view('components.category')->withInput();
                }
            }

        } catch (\Exception $ex) {
            //return view('components.category')->withInput();
        }

    }

    public function entityData(Request $request)
    {
        $categoryId = $request->input('category_data');
        if (isset($categoryId) && !empty($categoryId)) {
            $entityName = $request->input('subcategory_data');
            if (isset($entityName) && $entityName == "Select") {
                $entities = Entity::where('entity_id', $categoryId)
                    ->get();
                return response()->json($entities);
            } else if (isset($entityName) && !empty($entityName)) {
                $entities = Entity::where('entity_id', $categoryId)
                    ->where('name', $entityName)
                    ->get();

                return response()->json($entities);
            }
        } else {

        }

    }

    public function storeOrder(Request $request)
    {
        try {
            // return "jlkjlk";
            //return response()->json(["msg"=>"successs"]);
            // $name = $request->input('name');
            // $description = $request->input('description');
            // $diameter = $request->input('diameter');
            // $size = $request->input('size');
            // $quantity = $request->input('quantity');
            // $measurement = $request->input('measurement');

            $order = new Order();
            // $order->category_name = $name;
            // $order->description = $description;
            // $order->diameter = $diameter;
            // $order->size = $size;
            // $order->quantity = $quantity;
            // $order->measurement = $measurement;
            $order->status = "New";
            $order->user_id = Auth::user()->id;
            $order->save();

            if ($order->save()) {
                $latestId = Order::latest()->first()->id;
                if (isset($latestId) && !empty($latestId)) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $latestId;
                    $orderItem->category_name = $request->input('name');
                    $orderItem->description = $request->input('description');
                    $orderItem->diameter = $request->input('diameter');
                    $orderItem->size = $request->input('size');
                    $orderItem->quantity = $request->input('quantity');
                    $orderItem->measurement = $request->input('measurement');
                    $orderItem->save();
                    return response()->json(["response" => "successful"]);
                }

            }
        } catch (\Exception $ex) {

        }
        // return response()->json(["msg"=>$name]);
    }


    public function booking(Request $request)
    {
        // if (Auth::check()) {
        //     $bookingData = Order::where('user_id', Auth::user()->id)->where('status', 'Approved')->get();
        //     return view('components.booking', compact('bookingData'));
        // }

        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

            foreach ($orders as $order) {
                $order->orderItems = OrderItem::where('order_id', $order->id)->get();
            }

            return view('components.booking', compact('orders'));
        }
    }

    public function order(Request $request)
    {
        // if (Auth::check()) {
        //     $bookingData = Order::where('user_id', Auth::user()->id)->where('status', 'Dispatched')->get();
        //     return view('components.order', compact('bookingData'));
        // }

        // if (Auth::check()) {
        //     $orders = Order::where('user_id', Auth::user()->id)->get();

        //     foreach ($orders as $order) {
        //         $order->orderItems = OrderItem::where('order_id', $order->id)->get();
        //     }

        //     return view('components.order', compact('orders'));
        // }

        if (Auth::check()) {
            //$orders = Order::where('user_id', Auth::user()->id)->where('status', 'Dispatched')->orderBy('created_at', 'desc')->get();
            $orders = Order::where('user_id', Auth::user()->id)
    ->where(function ($query) {
        $query->where('status', 'Dispatched')
            ->orWhere('status', 'Payment_Done');
    })
    ->orderBy('created_at', 'desc')
    ->get();

            foreach ($orders as $order) {
                $order->orderItems = OrderItem::where('order_id', $order->id)->get();
            }

            return view('components.order', compact('orders'));
        }

    }

    public function records(Request $request)
    {
        //return response()->json(["msg" => "success"]);
        $product=$request->input('product');
        $quantity=$request->input('quantity');
        $description=$request->input('description');
        if(isset($product) && !empty($product) && isset($quantity) && !empty($quantity))
        {
            $query=new Records;
            $query->product=$product;
            $query->quantity=$quantity;
            $query->description=$description;
            $query->save();
            if($query->save())
            {
                return response()->json(["status"=>"success", "statusCode"=>200]);
            }
        }
    }

    public function storeSupervisor(Request $request)
    {
        $count = $request->hidden;
        $data = new Records;
        //dd($count);
        for ($a = 0; $a < $count; $a++) {

            $data->product = $request->input('product');
            $data->quantity = $request->input('quantity');
            $data->description = $request->input('notes');

        }
        $data->save();

        //dd($data->save);
        return redirect('/admin/records');
    }


    //verifyAdminStatusOrder
    public function verifyAdminStatusOrder(Request $request)
    {
        // try {
        //     if (Auth::check()) {

        //              $id = Auth::user()->id;
        //             if (isset($id)) {
        //         $status = Order::where('user_id', $id)->value('status');
        //                 return response()->json(["msg" => "success", "statusCode" => "200", "orderStatus" => $status]);
        //             }

        //     }
        // } catch (\Exception $ex) {

        // }
        // //return response()->json(["msg"=>"success"]);

        try {
            if (Auth::check()) {
                $adminStatus = $request->input('adminStatus');

                if (isset($adminStatus) && !empty($adminStatus)) {
                    $id = Auth::user()->id;
                    if (isset($id)) {
                        $status = Order::where('user_id', $id)->where('status', $adminStatus)->value('status');
                        return response()->json(["msg" => "success", "statusCode" => "200", "orderStatus" => $status]);
                    }
                }
            }
        } catch (\Exception $ex) {

        }
        //return response()->json(["msg"=>"success"]);
    }

    public function verifyAdminStatus(Request $request)
    {
        try {
            if (Auth::check()) {
                $adminStatus = $request->input('adminStatus');

                if (isset($adminStatus) && !empty($adminStatus)) {
                    $id = Auth::user()->id;
                    if (isset($id)) {
                        $status = Order::where('user_id', $id)->where('status', $adminStatus)->value('status');
                        return response()->json(["msg" => "success", "statusCode" => "200", "orderStatus" => $status]);
                    }
                }
            }
        } catch (\Exception $ex) {

        }
        //return response()->json(["msg"=>"success"]);
    }





    public function storing(Request $request)
    {
        $hide = $request->hide;
        $product = $request->product;
        $quantity = $request->quantity;

        for ($a = 0; $a < $hide; $a++) {
            $data = new Records();
            $data->product = $product[$a];
            $data->quantity = $quantity[$a];
            $data->description = $request->description;
            $data->save();

        }
        return redirect('/admin/records');
    }


    public function storeOrderBulk(Request $request)
    {
        try {
            if (Auth::check()) {
                $rowsValues = $request->input('rowsValues');

                $items = count($rowsValues);
                if (isset($rowsValues) && count($rowsValues) > 0) {

                    $order = new Order();
                    // $order->category_name = $name;
                    // $order->description = $description;
                    // $order->diameter = $diameter;
                    // $order->size = $size;
                    // $order->quantity = $quantity;
                    // $order->measurement = $measurement;
                    $order->status = "New";
                    $order->user_id = Auth::user()->id;
                    $order->save();

                    if ($order->save()) {
                        $latestId = Order::latest()->first()->id;

                        foreach ($rowsValues as $data) {
                            // $order = new Order;
                            // // $category_name = $data->name;
                            // // $description = $data->description;
                            // // $diameter = $data->diameter;
                            // // $size = $data->size;
                            // // $quantity = $data->quantity;
                            // // $measurement = $data->measurement;

                            // $order->category_name = $data['name'];
                            // $order->description = $data['description'];
                            // $order->diameter = $data['diameter'];
                            // $order->size = $data['size'];
                            // $order->quantity = $data['quantity'];
                            // $order->measurement = $data['measurement'];
                            // $order->user_id = Auth::user()->id;
                            // $order->save();

                            $orderItem = new OrderItem();
                            $orderItem->order_id = $latestId;
                            $orderItem->category_name = $data['name'];
                            $orderItem->description = $data['description'];
                            $orderItem->diameter = $data['diameter'];
                            $orderItem->size = $data['size'];
                            $orderItem->quantity = $data['quantity'];
                            $orderItem->measurement = $data['measurement'];
                            $orderItem->save();

                        }
                    }
                }
            }
        } catch (\Exception $ex) {

        }
    }


    public function payment_info_store(Request $request)
    {
      try
      {
        $dropDownPayment=$request->input('dropDownPayment');
        $name=$request->input('name');
        $date_value=$request->input('date_value');
        $cvv=$request->input('cvv');
        $transaction_no=rand(1000,100000);
        $order_id=rand(10,1000);
        $transaction_date=Carbon::now();

        if(isset($dropDownPayment) && isset($name) && isset($date_value) && isset($cvv) && isset($transaction_no)  && isset($order_id) && isset($transaction_date))
        {
            $UserPayment=new UserPayment();
            $UserPayment->source=$dropDownPayment;
            $UserPayment->transaction_date=$transaction_date;
            $UserPayment->transaction_id= $transaction_no;
            $UserPayment->user_id=Auth::user()->id;
            $UserPayment->orderno=$order_id;
            $UserPayment->payment_status="Success";
            // $UserPayment->save();
            if($UserPayment->save())
            {
                return redirect()->route('congratulations');
            }
           
        }
      }
      catch(\Exception $ex)
      {

      }
    }

    public function supervisor(Content $content)
    {
        $data = Entity::all();
        return $content->body(view('supervisor',compact('data')));
        
    }
}