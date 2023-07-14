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
    public function add_brand(){
        return view('admin.add-brand-product');
    }
    public function all_brand(){
        $all_brand = DB::table('tbl_brand')->get();
        $manager_brand = view('admin.all-brand-product')->with('all_brand',$all_brand);
        return view('admin_layout')->with('all-brand-product',$manager_brand);
    }
    public function save_brand(Request $request){
        $data=array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        $data['brand_status']=$request->brand_product_status;
       
        DB::table('tbl_brand')->insert($data);
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand-product');
    }
    public function unactive_brand($brand_id){
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand($brand_id){
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_category($category_id){
        $edit_category = DB::table('tbl_category_product')->where('category_id',$category_id)->get();//get() lấy theo id
        $manager_category = view('admin.edit-category-product')->with('edit_category',$edit_category);
        return view('admin_layout')->with('admin.edit-category-product',$manager_category);
    }
    public function update_category(Request $request,$category_id){
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
        return Redirect::to('all-category-product');
    }
    public function remove_category($category_id){
        DB::table('tbl_category_product')->where('category_id',$category_id)->delete();
        return Redirect::to('all-category-product');
    }
}
