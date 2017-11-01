<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Vouchers;
use Redirect;
use App\Mail\VoucherGenerated;
use Mail;
use Sentinel;
use App;
use Exception;

class VouchersController extends Controller
{
    public function curl_create_coupon($discount_duration_months, $discount_type, $voucherID, $amount, $percentage, $redeem_by)
    {
        $apiKey = env("STRIPE_SECRET", "sk_test_2vUdWcST87aHIL9bfpYjH22T");
        $curl = curl_init();

        if($discount_type == 1){
            
              $query = http_build_query(array(
                "id" => $voucherID,
                "max_redemptions" => 1,
                "duration" => "repeating",
                "duration_in_months" => $discount_duration_months,
                "currency" => "USD",
                "amount_off" => $amount*100,
                "redeem_by" => $redeem_by
            ));

        }else{
              $query = http_build_query(array(
                "id" => $voucherID,
                "max_redemptions" => 1,
                "duration" => "repeating",
                "duration_in_months" => $discount_duration_months,
                "percent_off" => $percentage,
                "redeem_by" => $redeem_by
            ));
        }

        /*curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://api.stripe.com/v1/invoices/upcoming?" . $query,
            CURLOPT_HTTPHEADER => array("Authorization: Bearer " . $apiKey),
        ));*/
        curl_setopt($curl, CURLOPT_URL, "https://api.stripe.com/v1/coupons");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $apiKey));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS,$query);
        $get_switch_cost = curl_exec($curl);
        curl_close($curl);
        /*echo json_encode($get_switch_cost);
        die;*/
        return $get_switch_cost;
    }

    public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getCreateVouchers(){
         /*echo strtoupper($this->generateRandomString(10)) ."1";
         die;*/
        return view('admin.vouchers.createvouchers');
    }

    public function postCreatedVoucher(Request $request){

        //check that the maximum number of months is 12 
        if($request->discount_duration > 12){
            return Redirect::back()->with('error', 'Number of months cannot be greater than 12');
        }

        //generate multiple vouchers depending on the number specified 
        $counter = 1;
        while($counter <= $request->max_redemptions){
        $count_vouchers = Vouchers::count();
        $voucher_number = strtoupper($this->generateRandomString(10)) .($count_vouchers+1);
        
        $vouchers_model = new Vouchers;
        $vouchers_model->voucher_name = $request->voucher_name;
        $vouchers_model->owner_name = $request->owner_name;
        $vouchers_model->email = $request->email;
        $vouchers_model->discount_type = $request->discount_type;
        $vouchers_model->percentage_discount = $request->percentage_discount;
        $vouchers_model->amount_discount = $request->amount;
        $vouchers_model->max_redemptions = $request->max_redemptions;
        $vouchers_model->discount_duration_months = $request->discount_duration;
        $vouchers_model->redeem_by = $request->redeem_by;
        $vouchers_model->voucher_number = $voucher_number;
        $vouchers_model->created_at = Carbon::now();
        $insert_voucher = $vouchers_model->save();

         if($insert_voucher){
            //the process below needs to be queued
            $this->curl_create_coupon($request->discount_duration, $request->discount_type, $voucher_number, $request->amount, $request->percentage_discount, strtotime($request->redeem_by));
         }

         //generate a pdf voucher

        $counter++;
        }

       $for_all_vouchers = new Vouchers;
       $all_vouchers = $for_all_vouchers->limit($request->max_redemptions)->orderBy('id', 'desc')->get();
       
       Mail::to($request->email)->send(new VoucherGenerated($vouchers_model, $all_vouchers));
       return Redirect::back()->with('success', 'Voucher generation was successful');

    }

    public function redeemVoucher(){
        return view('redeemvoucher');
    }

    public function postRedeemVoucher(Request $request){
        //get the user 
        $user = Sentinel::getUser();

        //check that the user is not on free trial 
        
        try {
             $user->applyCoupon($request->voucher_number);
             return Redirect::back()->with('success','Voucher successfuly applied');
           } catch (Exception $e) {
             return Redirect::back()->with('error',$e->getMessage());
          }
      }
}
