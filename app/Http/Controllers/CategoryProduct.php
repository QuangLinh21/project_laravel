<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
{
    public function add_category(){
        return view('admin.add-category-product');
    }
    public function all_category(){
        $all_category = DB::table('tbl_category_product')->get();
        $manager_category = view('admin.all-category-product')->with('all_category',$all_category);
        return view('admin_layout')->with('all-category-product',$manager_category);
    }
    public function save_category(Request $request){
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        $data['category_status']=$request->category_product_status;
       
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');
    }
    public function unactive_category($category_id){
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt trạng thái không thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category($category_id){
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-category-product');
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
