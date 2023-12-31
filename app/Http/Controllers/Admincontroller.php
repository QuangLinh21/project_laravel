<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class Admincontroller extends Controller
{
    public function check_login(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
           return Redirect::to('admin')->send();
        }
    }
    public function index(){
       
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->check_login();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;
        $result = DB::table('tbl_admin')->where ('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        //first() là lấy ra 1 bản ghi duy nhất
        if($result){
            Session::put('admin_name',$result->admin_name);
            // Session::put('admin_name',$result->admin_name:lấy từ biến result);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Mật khẩu hoặc tài khoản không đúng');
            return Redirect::to('/admin');
        }
    }
    public function logout(Request $request){
        $this->check_login();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
    public function all_order_detail(){
        $all_order_detail = DB::table('tbl_order')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        //->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->get();
        $manager_order = view('admin.all-order-detail')->with('all_order_detail',$all_order_detail);
        return view('admin_layout')->with('admin.all-order-detail',$manager_order);
    }

    //blog
    
}
