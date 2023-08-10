<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();

class PaymentController extends Controller
{
     //payment 
     public function end_payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        $info_shipping = DB::table('tbl_shipping')
        ->join('tbl_customers','tbl_shipping.customer_id','=','tbl_customers.customer_id')->where('tbl_shipping.customer_id',Session::get('customer_id'))->orderBy('tbl_shipping.shipping_id','desc')->get();
        Session::put('shipping_id',  $info_shipping);
        return view('pages.login-checkout.end-payment')->with('category',$cate_product)->with('brand',$brand_product)->with('info_shipping',$info_shipping);
    }
    public function show_payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        return view('pages.login-checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function info_payment_product(Request $request){
        $data = array();
        $data['customer_id'] = Session::get('customer_id');
        $data['ship_customer_phone'] = $request->shipping_phone;
        $data['ship_customer_address'] = $request->shipping_address;
        $data['ship_customer_note'] = $request->shipping_note;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);//insertGetId để thêm vào và lấy luôn ra
        // Session::put('shipping_id',  $shipping_id);
        return Redirect::to('end-payment');
    }
    public function order_product(Request $request){
        $shipping_id = DB::table('tbl_customers')
        ->join('tbl_shipping', 'tbl_customers.customer_id', '=', 'tbl_shipping.customer_id')
        ->where('tbl_shipping.customer_id',Session::get('customer_id'))->select('shipping_id')->first();
        Session::put('shipping_id', $shipping_id);
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
        $order_data['order_total'] =strval(Session::get('total'));
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId( $order_data );//insertGetId để thêm vào và lấy luôn ra

        //insert order detail
        // $content = Cart::content();
        foreach(Session::get('cart') as $v_content){
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content['cart_product_id'];
            $order_details_data['product_name'] = $v_content['cart_product_name'];
            $order_details_data['product_price'] =$v_content['cart_product_price'];
            $order_details_data['product_quantity'] = $v_content['cart_product_qty'];
             DB::table('tbl_order_details')->insert($order_details_data);//insertGetId để thêm vào và lấy luôn ra
        }
        if($data['payment_method']==1){
            Session::get('cart')::destroy(); //reset giỏ hàng
            echo 'thanh toán atm';

        }
        else{
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
            Session::get('cart')::destroy(); //reset giỏ hàng
           return view('pages.login-checkout.shipcod')->with('category',$cate_product)->with('brand',$brand_product)->with('shipping_id',
           $shipping_id);
        }
       
       
    }
     //admin manager-order
     public function manager_order(){
        
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderBy('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manager-order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manager-order',$manager_order);
       
     }
     public function view_order($order_id){
        
        return view('admin.view-order');
     }
     public function delete_address_ship($shipping_id){
        DB::table('tbl_shipping')->where('shipping_id',$shipping_id)->delete();
        return Redirect::to('end-payment');
     }
}
