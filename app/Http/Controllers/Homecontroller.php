<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
session_start();

class Homecontroller extends Controller
{
    public function index(Request $request){
        //SEO
        $meta_desc = "Cửa hàng bán lẻ điện thoại, máy tính laptop, smartwatch, smarthome, thiết bị IT, phụ kiện chính hãng - Giá tốt, trả góp 0%, giao miễn phí";
        $meta_keyword="ql shop, ql shop, ql shop, ql shop";
        $meta_title="Cửa hàng bán lẻ điện thoại, máy tính laptop, smartwatch, smarthome, thiết bị IT, phụ kiện chính hãng - Giá tốt, trả góp 0%, giao miễn phí";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        $all_product=DB::table('tbl_products')->where('product_status','0')->orderBy('product_id','desc')->limit(8)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
        ->with('meta_desc', $meta_desc)->with('meta_keyword', $meta_keyword)->with('meta_title',$meta_title)->with('url_canonical', $url_canonical);
        // return view('pages.home')->with(compact('cate_product'));
    }
    public function search_product(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        $keyword = $request->keyword_product;
        $search_product=DB::table('tbl_products')->where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.products.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }

    //send mail
    public function send_mail(){
        $to_name = "Quang Linh";
        $to_email = "nqlinh5501@gmail.com";
        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail liên quan đến khách hàng");
        Mail::send("pages.email.send-email",$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail');
            $message->from($to_email,$to_name);
        });
        return Redirect::to('/')->with('message','');

    }
}
