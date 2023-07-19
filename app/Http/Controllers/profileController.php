<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Address;
use Validator;
use Illuminate\Support\Facades\Log;

class profileController extends Controller
{
    public function profile()
    {
        try {
            $user = Auth::user();
            $address = Address::where('user_id', $user->id)->get()->last();
            return view('components.profile', compact('user', 'address'));
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
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
                $image->move(public_path('uploads'), $realname);
                $main->user_image = $realname;
            }
            $main->save();
            Alert::success('Profile updated successfully', 'Your profile has been successfully updated');
            return redirect()->back();
        } catch (\Exception $ex) {
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
            Alert::success('Image removed successfully', 'Your Image has been successfully removed');
            return redirect()->back();
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function addresssave(request $request)
    {

        try {
            $address = new Address();
            $valid = Validator::make($request->all(), [
                "shipname" => 'required',
                "shipgstnumber" => 'required|min:15|max:15',
                "shipgstcode" => 'required|min:2|max:2',
                "shipstate" => 'required',
                "shipcity" => 'required',
                "shipdistrict" => 'required',
                "shippincode" => 'required|min:6|max:6',
                "shipaddress" => 'required',
                "billname" => 'required',
                "billgstnumber" => 'required|min:15|max:15',
                "billgstcode" => 'required|min:2|max:2',
                "billstate" => 'required',
                "billcity" => 'required',
                "billdistrict" => 'required',
                "billpincode" => 'required|min:6|max:6',
                "billaddress" => 'required',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid);
            }
            $user_id = Address::where('user_id', Auth::user()->id)->get()->last();


            if ($user_id != "") {
                $user_id->user_id = Auth::user()->id;
                $user_id->shipping_name = $request->shipname;
                $user_id->shipping_gst_number = $request->shipgstnumber;
                $user_id->shipping_gst_statecode = $request->shipgstcode;
                $user_id->shipping_state = $request->shipstate;
                $user_id->shipping_city = $request->shipcity;
                $user_id->shipping_district = $request->shipdistrict;
                $user_id->shipping_zipcode = $request->shippincode;
                $user_id->shipping_address = $request->shipaddress;
                $user_id->billing_name = $request->billname;
                $user_id->billing_gst_number = $request->billgstnumber;
                $user_id->billing_gst_statecode = $request->billgstcode;
                $user_id->billing_state = $request->billstate;
                $user_id->billing_city = $request->billcity;
                $user_id->billing_district = $request->billdistrict;
                $user_id->billing_zipcode = $request->billpincode;
                $user_id->billing_address = $request->billaddress;
                $user_id->save();

                Alert::success('Data is updated', 'Your address has been updated succesfully ');

                return redirect()->back();
            } else {

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

                Alert::success('Data is saved', 'Your address has been store succesfully ');

                return redirect()->back();
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }

    }
}