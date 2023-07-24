<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class Homecontroller extends Controller
{
    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        $all_product=DB::table('tbl_products')->where('product_status','0')->orderBy('product_id','desc')->limit(6)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function search_product(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        $keyword = $request->keyword_product;
        $search_product=DB::table('tbl_products')->where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.products.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}
