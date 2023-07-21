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
    public function check_login(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
           return Redirect::to('admin')->send();
        }
    }
    public function add_category(){
        $this->check_login();
        return view('admin.add-category-product');
    }
    public function all_category(){
        $all_category = DB::table('tbl_category_product')->get();
        $manager_category = view('admin.all-category-product')->with('all_category',$all_category);
        return view('admin_layout')->with('all-category-product',$manager_category);
    }
    public function save_category(Request $request){
        $this->check_login();
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        $data['category_status']=$request->category_product_status;
       
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');
    }
    public function unactive_category($category_id){
        $this->check_login();
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt trạng thái không thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category($category_id){
        $this->check_login();
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category($category_id){
        $this->check_login();
        $edit_category = DB::table('tbl_category_product')->where('category_id',$category_id)->get();//get() lấy theo id
        $manager_category = view('admin.edit-category-product')->with('edit_category',$edit_category);
        return view('admin_layout')->with('admin.edit-category-product',$manager_category);
    }
    public function update_category(Request $request,$category_id){
        $this->check_login();
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
        return Redirect::to('all-category-product');
    }
    public function remove_category($category_id){
        $this->check_login();
        DB::table('tbl_category_product')->where('category_id',$category_id)->delete();
        return Redirect::to('all-category-product');
    }

    //end function admin 
    public function show_category_user($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $category_by_id=DB::table('tbl_products')->join('tbl_category_product','tbl_products.category_id','=','tbl_category_product.category_id')->where('tbl_products.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        return view('pages.category_brand.category-product-user')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
   
}
