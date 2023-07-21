<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
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
    public function add_brand(){
        $this->check_login();
        return view('admin.add-brand-product');
    }
    public function all_brand(){
        $this->check_login();
        $all_brand = DB::table('tbl_brand')->get();
        $manager_brand = view('admin.all-brand-product')->with('all_brand',$all_brand);
        return view('admin_layout')->with('all-brand-product',$manager_brand);
    }
    public function save_brand(Request $request){
        $this->check_login();
        $data=array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        $data['brand_status']=$request->brand_product_status;
       
        DB::table('tbl_brand')->insert($data);
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand-product');
    }
    public function unactive_brand($brand_id){
        $this->check_login();
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand($brand_id){
        $this->check_login();
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand($brand_id){
        $this->check_login();
        $edit_brand = DB::table('tbl_brand')->where('brand_id',$brand_id)->get();
        $manager_brand = view('admin.edit-brand-product')->with('edit_brand',$edit_brand);
        return view('admin_layout')->with('admin.edit-brand-product',$manager_brand);
    }
    public function update_brand(Request $request,$brand_id){
        $this->check_login();
        $data=array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update($data);
        return Redirect::to('all-brand-product');
    }
    public function remove_brand($brand_id){
        $this->check_login();
        DB::table('tbl_brand')->where('brand_id',$brand_id)->delete();
        return Redirect::to('all-brand-product');
    }
    //end function admin 
    public function show_brand_user($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $brand_by_id=DB::table('tbl_products')->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')->where('tbl_products.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        return view('pages.category_brand.brand-product-user')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
