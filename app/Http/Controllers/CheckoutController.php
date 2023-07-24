<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        return view('pages.login-checkout.login-checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);//insertGetId để thêm vào và lấy luôn ra
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect('payment');
    }
    
    public function checkout(){
        Session::flush();
        return Redirect::to('login-checkout');
    }
    public function login_customer(Request $request){
        $username = $request->username;
        $password = md5($request->password);
        $result = DB::table('tbl_customers')->where('customer_email',$username)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('cart-product');
        }
        else{
            return Redirect::to('login-checkout');
        }
       
    }
    //payment 
    public function end_payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        return view('pages.login-checkout.end-payment')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function show_payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        return view('pages.login-checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function info_payment_product(Request $request){
        $data = array();
        $data['ship_customer_name'] = $request->shipping_name;
        $data['ship_customer_email'] = $request->shipping_email;
        $data['ship_customer_phone'] = $request->shipping_phone;
        $data['ship_customer_address'] = $request->shipping_address;
        $data['ship_customer_note'] = $request->shipping_note;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);//insertGetId để thêm vào và lấy luôn ra
        Session::put('shipping_id',$shipping_id);
        return Redirect('end-payment');
    }
    public function order_product(Request $request){

        //insert payment method 
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);//insertGetId để thêm vào và lấy luôn ra

        //insert order 
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId( $order_data );//insertGetId để thêm vào và lấy luôn ra

        //insert order detail
        $content = Cart::content();
        foreach($content as $v_content){
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content->id;
            $order_details_data['product_name'] = $v_content->name;
            $order_details_data['product_price'] =$v_content->price;
            $order_details_data['product_quantity'] = $v_content->qty;
             DB::table('tbl_order_details')->insert($order_details_data);//insertGetId để thêm vào và lấy luôn ra
        }
        if($data['payment_method']==1){
            echo 'thanh toán atm';

        }
        else{
            echo 'shipcod';
        }
       
        //  return Redirect('order-product');
    }
    
}
