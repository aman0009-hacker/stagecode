<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\PSIECMail;
class invalidmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invalid:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{

            $userdata=User::leftJoin('orders','users.id','=','orders.user_id')
            ->where('orders.payment_mode','cheque')
            ->where('orders.final_payment_status','unverified')
            ->whereNotNull('orders.interest_amount')
            ->get();
            foreach($userdata as $singledata)
            {
                $orderid=\Crypt::encryptString($singledata->id);
        $details=[
            "email"=>"Invalid Cheque Payment for Order $singledata->order_no",
             "body"=>"We regret to inform you that your order with $singledata->order_no has been initiated to online payment.To faciliate the completion of this procss , So we kindly request you to make the full payment. ",
             "status"=>"Invalidcheque",
             'orderid'=>$orderid
        ];

                \Mail::to($singledata->email)->send(new PSIECMail($details));
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }
}
