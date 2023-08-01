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
    public function check_login()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id')->get();
        return view('pages.login-checkout.login-checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data); //insertGetId để thêm vào và lấy luôn ra
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect('/');
    }

    public function checkout()
    {
        Session::flush();
        return Redirect::to('login-checkout');
    }
    public function login_customer(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);
        $result = DB::table('tbl_customers')
            // ->join('tbl_shipping', 'tbl_customers.customer_id', '=', 'tbl_shipping.customer_id')
            ->where('customer_email', $username)->where('customer_password', $password)->first();
           
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            // Session::put('shipping_id',$result->shipping_id);

            return Redirect::to('/');
        } else {
            return Redirect::to('login-checkout');
        }
    }
}
