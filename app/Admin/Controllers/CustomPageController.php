<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Mail\Attachment;
use ZipArchive;
use App\Models\User;
// use App\Models\Comments;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Comments;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\State;
use App\Models\City;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Models\Records;


class CustomPageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Example controller';

    public function getCities(Request $request)
    {
        try {
            $stateName = $request->input('q');
            $stateId = State::where('name', $stateName)->first()->id;
            $cities = City::where('state_id', $stateId)->pluck('name', 'id');
            return $cities;
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function PaymentDetails(Request $request, $id)
    {
        try {
            $id = (Crypt::decryptString($id));
            //   dd($id);
            $count = 0;
            if (isset($id) && !empty($id)) {
                $query = User::all();
                foreach ($query as $data) {
                    if ($data->id == ($id)) {
                        $count++;
                        break;
                    }
                }
                if ($count == 1) {
                    return view('components.payment-details');
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
            return view('auth.login');
        }
    }


    public function PaymentDetailsOrder(Request $request, $id, $status)
    {
        try {
            $id = (Crypt::decryptString($id));
            //   dd($id);
            $count = 0;
            if (isset($id) && !empty($id)) {
                $query = Order::all();
                foreach ($query as $data) {
                    if ($data->id == ($id)) {
                        $count++;
                        break;
                    }
                }
                if ($count == 1) {
                    return view('components.payment');
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
            return view('auth.login');
        }
    }

    public function chartApproveStatus(Request $request)
    {
        try {
            $value1 = 0;
            $value2 = 1;
            $value3 = 2;
            $result = DB::table('users')
                ->selectRaw('count(*) as total_count')
                ->selectSub(function ($query) use ($value1) {
                    $query->selectRaw('count(approved)')
                        ->from('users')
                        ->where('approved', '=', $value1);
                }, 'column1_count')
                ->selectSub(function ($query) use ($value2) {
                    $query->selectRaw('count(approved)')
                        ->from('users')
                        ->where('approved', '=', $value2);
                }, 'column2_count')
                ->selectSub(function ($query) use ($value3) {
                    $query->selectRaw('count(approved)')
                        ->from('users')
                        ->where('approved', '=', $value3);
                }, 'column3_count')
                ->first();
            if (isset($result)) {
                $totalCount = $result->total_count;
                $newCount = $result->column1_count;
                $approveCount = $result->column2_count;
                $rejectCount = $result->column3_count;
                $data = [];
                //$data[] = $totalCount;
                $data[] = $newCount;
                $data[] = $approveCount;
                $data[] = $rejectCount;
                return response()->json(['msg' => "success", 'data' => $data]);
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());

        }
    }


    public function adminMsgHandling(Request $request)
    {
        try {
            $adminMsg = $request->input('adminTxt');
            $userMsg = $request->input('admin-message');
            $adminData = $request->input('user-message');
            $userID = session('current_row_id');
            $affected = DB::table('users')
                ->where('id', $userID)
                ->update(['comment' => $adminMsg]);
            // $previousAdmin = DB::table('comments')->where('user_id', 1)->where('supervisor', 'admin')->whereNotNull('comment')->select('comment')->orderBy('id', 'desc')->get();
            $previousAdmin = Comments::where('user_id', 1)
                ->where('supervisor', 'admin')
                ->whereNotNull('comment')
                ->select('comment')
                ->orderBy('id', 'desc')
                ->get();
            // $previousUSer = DB::table('comments')->where('user_id', 1)->where('supervisor', 'user')->whereNotNull('comment')->select('comment')->orderBy('id', 'desc')->get();
            $previousUser = Comments::where('user_id', 1)
                ->where('supervisor', 'user')
                ->whereNotNull('comment')
                ->select('comment')
                ->orderBy('id', 'desc')
                ->get();
            if (isset($affected)) {
                //code to send mail start
                $details = [
                    'email' => 'Mail from PSIEC Admin Panel',
                    'body' => 'Admin Panel has requested the following information' . "  . Kindly resolve the issues as follows:-" . $adminMsg
                ];
                //\Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));
                \Mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
                //code to send mail end
                return response()->json(['success' => "completed", 'adminMsg' => $adminMsg, 'previousAdmin' => $previousAdmin, 'previousUSer' => $previousUser]);
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());

        }
    }

    public function adminDownload(Request $request)
    {
    }

    public function index(Content $content)
    {
        return $content
            ->title('User Documents')
            ->description('List of your resource');
        // ->body($this->grid())
        // ->view('admin.custom-page');
    }

    public function checkurl(Request $request)
    {
        try {
            $adminrole = $request->input('adminusername');
            $adminusername = $request->input('adminusername');
            $adminid = $request->input('adminid');
            $userid = $request->input('userid');
            $textAreaMsg = $request->input('textAreaMsg');
            $query = User::find($userid);
            if ($query) {
                $approvedStatus = $query->approved;
                // if ($approvedStatus == 2 || $approvedStatus == 0) {
                if ($approvedStatus == 2 || $approvedStatus == 0 || $approvedStatus == 1) {
                    if (isset($textAreaMsg) && isset($adminid) && isset($userid)) {
                        $data = new Comments;
                        $data->admin_id = $adminid;
                        $data->user_id = $userid;
                        $data->comment = $textAreaMsg;
                        $data->username = $adminusername;
                        $data->commented_by = "admin";
                        // $data->username= $adminusername;
                        // $data->save();
                        if ($data->save()) {
                            $latestData = Comments::latest()->where('admin_id', $adminid)->where('user_id', $userid)->take(5)->get();
                            //$latestData=Comments::where('id',$lastInsertedId->id)->first();
                            return response()->json([
                                "msg" => "success",
                                "adminid" => $adminid,
                                "data" => $data,
                                'adminrole' => $adminrole,
                                "userid" => $userid,
                                "adminusername" => $adminusername,
                                "textAreaMsg" => $textAreaMsg,
                                'latestData' => $latestData
                            ]);
                        }
                    }
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function checkurlIndex(Request $request)
    {
        try {
            $adminrole = $request->input('adminusername');
            $adminusername = $request->input('adminusername');
            $adminid = $request->input('adminid');
            $userid = $request->input('userid');
            $textAreaMsg = $request->input('textAreaMsg');
            $query = User::find($userid);
            if ($query) {
                $status = $query->approved;
                //if ($status == 2 || $status == 0) {
                if ($status == 2 || $status == 0 || $status == 1) {
                    if (isset($adminid) && isset($userid)) { {
                            $latestData = Comments::latest()->where('admin_id', $adminid)->where('user_id', $userid)->take(5)->get();
                            //$latestData=Comments::where('id',$lastInsertedId->id)->first();
                            return response()->json([
                                "msg" => "success",
                                "adminid" => $adminid,
                                'adminrole' => $adminrole,
                                "userid" => $userid,
                                "adminusername" => $adminusername,
                                "textAreaMsg" => $textAreaMsg,
                                'latestData' => $latestData
                            ]);

                        }
                    }
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function chatData(Request $request)
    {
        try {
            //return response()->json(["msg"=>"success"]);
            $messageData = $request->input('textAreaMsg');
            // $queryData = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->
            //     where('comments.user_id', Auth::user()->id)->orderBy('comments.created_at', 'desc')->select('comments.*')->first();
            $queryData = User::join('comments', 'users.id', '=', 'comments.user_id')
                ->where('comments.user_id', auth()->user()->id)
                ->orderBy('comments.created_at', 'desc')
                ->select('comments.*')
                ->first();
            $admin_id = $queryData->admin_id;
            if (isset($messageData) && !empty($messageData)) {
                $data = new Comments;
                $data->admin_id = $admin_id;
                $data->user_id = Auth::user()->id;
                $data->comment = $messageData;
                // $data->username=$adminusername;
                $data->commented_by = "user";
                $data->username = Auth::user()->name;
                $data->save();

                if ($data->save()) {
                    $latestData = Comments::latest()->where('admin_id', $admin_id)->where('user_id', Auth::user()->id)->take(5)->get();
                    //$latestData=Comments::where('id',$lastInsertedId->id)->first();
                    return response()->json(["msg" => "success", 'latestData' => $latestData]);
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function chatDataPost(Request $request)
    {
        try {
            // $queryData = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->
            //     where('comments.user_id', Auth::user()->id)->orderBy('comments.created_at', 'desc')->select('comments.*')->first();
            $queryData = User::join('comments', 'users.id', '=', 'comments.user_id')
                ->where('comments.user_id', auth()->user()->id)
                ->orderBy('comments.created_at', 'desc')
                ->select('comments.*')
                ->first();
            $admin_id = $queryData->admin_id;
            if (isset($queryData)) {
                $latestData = Comments::latest()->where('admin_id', $admin_id)->where('user_id', Auth::user()->id)->take(5)->get();
                //$latestData=Comments::where('id',$lastInsertedId->id)->first();
                return response()->json(["msg" => "success", 'latestData' => $latestData]);
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }


    public function start(Request $request)
    {
        try {
            $checkCurrentUserId = Auth::user()->id;
            // $queryData = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->
            //     where('comments.user_id', $checkCurrentUserId)->orderBy('comments.created_at', 'desc')->select('comments.*')->get();
            $queryData = User::join('comments', 'users.id', '=', 'comments.user_id')
                ->where('comments.user_id', $checkCurrentUserId)
                ->orderBy('comments.created_at', 'desc')
                ->select('comments.*')
                ->get();
            return view('components.chat')->with(['queryData' => $queryData]);
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }


        /* chart function Start*/

        public function getTotalYardCount()
        {
    
            $Yards = Records::selectRaw('COUNT(id)
     as total_yards, YEAR(date) as year, MONTH(date) as month')
            ->groupBy('year', 'month')
            ->get();
    
            if(isset($yards) && !empty($yards))
            {
    
    
            foreach($Yards as $month)
            {
                $order_m=\DateTime::createFromFormat('!m',$month->month);
    
    
                $charmonth[]=$order_m->format('F');
    
            }
            // dd($charmonth);
    
            foreach($Yards as $month)
            {
                $chardate[]=$month->total_yards;
            }
    
            $myData=[
                'month'=>$charmonth,
                'numberOf'=>$chardate
             ];
            //  dd($myData);
             return response()->json(['msg' => "success", 'data' => $myData]);
            }
            else
            {
                // return response()->json(['msg' => "Error", 'data' => 'null']);
            }
        }
        public function getTotalUsersCount()
        {
    
            $user_per_month = User::selectRaw('COUNT(id)
     as total_users, YEAR(created_at) as year, MONTH(created_at) as month')
            ->groupBy('year', 'month')
            ->get();
    
            if(isset($user_per_month) && !empty($user_per_month))
            {
    
            foreach($user_per_month as $month)
            {
                $order_m=\DateTime::createFromFormat('!m',$month->month);
    
    
                $charmonth[]=$order_m->format('F');
    
            }
    
            foreach($user_per_month as $month)
            {
                $chardate[]=$month->total_users;
            }
            // dd($chardate);
    
            $myData=[
                'month'=>$charmonth,
                'numberOf'=>$chardate
             ];
    
             return response()->json(['msg' => "success", 'data' => $myData]);
            }
            else
            {
                // return response()->json(['msg' => "error", 'data' => 'null']);
    
            }
        }
        public function getTotalOrdersCount()
        {
    
            $order_per_month = Order::selectRaw('COUNT(id)
     as total_orders, YEAR(created_at) as year, MONTH(created_at) as month')
            ->groupBy('year', 'month')
            ->get();
            // dd($orders);
            if(isset($order_per_month) && !empty($order_per_month))
            {
    
            foreach($order_per_month as $month)
            {
            $order_m=\DateTime::createFromFormat('!m',$month->month);
    
    
            $charmonth[]=$order_m->format('F');
    
            }
    
            foreach($order_per_month as $month)
            {
                $chardate[]=$month->total_orders;
            }
    
            $myData=[
                'month'=>$charmonth,
                'numberOf'=>$chardate
             ];
    
             return response()->json(['msg' => "success", 'data' => $myData]);
            }
            else
            {
                // return response()->json(['msg' => "error", 'data' => 'null']);
            }
        }
    
        public function getTotalOrdersAmount()
        {
            $amount_per_month=\DB::table('orders')
            ->selectRaw('SUM(amount) as total_orders, YEAR(created_at) as year, MONTH(created_at) as month')
            ->groupBy('year','month')->get();
    
            if(isset($amount_per_month) && !empty($amount_per_month))
            {
    
    
            foreach($amount_per_month as $month)
            {
            $order_m=\DateTime::createFromFormat('!m',$month->month);
    
            $charmonth[]=$order_m->format('F');
    
            }
            foreach($amount_per_month as $month)
            {
                $chardate[]=$month->total_orders;
            }
    
             $myData=[
                'month'=>$charmonth,
                'total'=>$chardate
             ];
    
            return response()->json(['msg' => "success", 'data' => $myData]);
            }
            else
            {
                // return response()->json(['msg' => "error", 'data' => 'null']);
    
            }
    
        }
    
        /* charts function End*/
}