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
        $all_product=DB::table('tbl_products')->where('product_status','0')->orderBy('product_id','desc')->limit(9)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
        ->with('meta_desc', $meta_desc)->with('meta_keyword', $meta_keyword)->with('meta_title',$meta_title)->with('url_canonical', $url_canonical);
        // return view('pages.home')->with(compact('cate_product'));
    }
    //blog
    public function show_blog(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();

        $show_blog = DB::table('tbl_blog')->where('quyen',0)->get();
        // $manager_blog = view('pages.blog')->with('show_blog',$show_blog);
        return view('pages.blog')->with('category',$cate_product)->with('brand',$brand_product)->with('show_blog',$show_blog);
    }
    public function add_blog(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        return view('pages.add-blog')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function send_blog(Request $request){
        $data=array();
        $date=getdate();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['title']=$request->title;
        $data['content']=$request->content;
        $data['time']=$date['hours'].':'.$date['minutes'];
        $data['date']=$date['mday'].'/'.$date['mon'].'/'.$date['year'];
        $data['quyen']='1';
        DB::table('tbl_blog')->insert($data);
        Session::put('message','Gửi Blog thành công');
        return Redirect::to('add-blog');
    }
    public function read_blog($blog_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        $full_blog=DB::table('tbl_blog')->where('blog_id',$blog_id)->get();
        return view('pages.full-blog')->with('category',$cate_product)->with('brand',$brand_product)->with('full_blog',$full_blog);
    }
    //contact
    public function show_contact(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        return view('pages.contact')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function send_contact(Request $request){
        $data=array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['subject']=$request->subject;
        $data['message']=$request->message;
        DB::table('tbl_contacts')->insert($data);
        Session::put('message','Gửi liên hệ thành công');
        return Redirect::to('contact');

    }
    public function list_product(Request $request){
        //SEO
        $meta_desc = "Cửa hàng bán lẻ điện thoại, máy tính laptop, smartwatch, smarthome, thiết bị IT, phụ kiện chính hãng - Giá tốt, trả góp 0%, giao miễn phí";
        $meta_keyword="ql shop, ql shop, ql shop, ql shop";
        $meta_title="Cửa hàng bán lẻ điện thoại, máy tính laptop, smartwatch, smarthome, thiết bị IT, phụ kiện chính hãng - Giá tốt, trả góp 0%, giao miễn phí";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id')->get();
        $all_product=DB::table('tbl_products')->where('product_status','0')->orderBy('product_id','desc')->get();
        return view('pages.list-product')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
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
