<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
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
    public function add_product(){
        $this->check_login();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add-product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->check_login();
        $all_product = DB::table('tbl_products')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_products.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_products.brand_id')->orderby('tbl_products.product_id','desc')->get();
        $manager_product = view('admin.all-product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all-product',$manager_product);
    }
    public function save_product(Request $request){
        $this->check_login();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->cate_product;
        $data['brand_id']=$request->brand_product;
        $data['product_desc']=$request->product_desc;
        $data['product_price']=$request->product_price;
        $data['product_status']=$request->product_status;

        $get_image=$request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_imgage =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product',$new_imgage);
            $data['product_image']=$new_imgage;
            DB::table('tbl_products')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('/add-product');
        }
        $data['product_image']='';
        DB::table('tbl_products')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/add-product');
    }
    public function edit_product($product_id){
        $this->check_login();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_products')->where('product_id',$product_id)->get();
        $manager_product= view('admin.edit-product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit-brand-product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->check_login();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->cate_product;
        $data['brand_id']=$request->brand_product;
        $data['product_desc']=$request->product_desc;
        $data['product_price']=$request->product_price;
        $data['product_status']=$request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_imgage =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product',$new_imgage);
            $data['product_image']=$new_imgage;
            DB::table('tbl_products')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        DB::table('tbl_products')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function remove_product($product_id){
        $this->check_login();
        DB::table('tbl_products')->where('product_id',$product_id)->delete();
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this->check_login();
        DB::table('tbl_products')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->check_login();
        DB::table('tbl_products')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt trạng thái thành công');
        return Redirect::to('all-product');
    }
}
