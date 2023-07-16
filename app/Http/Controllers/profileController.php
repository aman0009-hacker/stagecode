<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Models\Address;
use Validator;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function profile()
    {
        $user=Auth::user();
        $address= address::where('user_id',$user->id)->get()->last();
        return view('components.profile',compact('user','address'));
    }
    public function storedata(Request $request)
    {
        try {
            $id = $request->id;
            $main = user::find($id);
            $main->name = $request->firstname;
            $main->last_name = $request->lastname;
            $main->email = $request->email;
            $main->contact_number = $request->number;
            if ($request->file) {
                $image = $request->file;
                $realname = time() . "." . $image->getClientOriginalExtension();
                $image->move(public_path('upload'), $realname);
                $main->user_image = $realname;
            }
            $main->save();
            Alert::success('Profile has updated successfully', 'Your profile has been successfully updated');
            return redirect()->back();
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }

    }

    public function removeimage(request $request)
    {
        try {
            $id = $request->userimageid;
            $data = user::find($id);
            $data->user_image = "";
            $data->save();
            Alert::success('Image has removed successfully', 'Your Image has been successfully removed');
            return redirect()->back();
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function addresssave(request $request)
    {
        try {
        $address = new Address();
        $valid = Validator::make($request->all(), [
            "shipname" => 'required',
            "shipgstnumber" => 'required',
            "shipgstcode" => 'required',
            "shipstate" => 'required',
            "shipcity" => 'required',
            "shipdistrict" => 'required',
            "shippincode" => 'required',
            "shipaddress" => 'required',
            "billname" => 'required',
            "billgstnumber" => 'required',
            "billgstcode" => 'required',
            "billstate" => 'required',
            "billcity" => 'required',
            "billdistrict" => 'required',
            "billpincode" => 'required',
            "billaddress" => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid);
        }
        $address->user_id = Auth::user()->id;
        $address->shipping_name = $request->shipname;
        $address->shipping_gst_number = $request->shipgstnumber;
        $address->shipping_gst_statecode = $request->shipgstcode;
        $address->shipping_state = $request->shipstate;
        $address->shipping_city = $request->shipcity;
        $address->shipping_district = $request->shipdistrict;
        $address->shipping_zipcode = $request->shippincode;
        $address->shipping_address = $request->shipaddress;
        $address->billing_name = $request->billname;
        $address->billing_gst_number = $request->billgstnumber;
        $address->billing_gst_statecode = $request->billgstcode;
        $address->billing_state = $request->billstate;
        $address->billing_city = $request->billcity;
        $address->billing_district = $request->billdistrict;
        $address->billing_zipcode = $request->billpincode;
        $address->billing_address = $request->billaddress;
        $address->save();
        Alert::success('Information has saved successfully', 'Your address has been store succesfully ');
        return redirect()->back();
    } catch (\Throwable $ex) {
        Log::info($ex->getMessage());
    }
    }
}