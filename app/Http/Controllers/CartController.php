<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Cart;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

session_start();

class CartController extends Controller
{
    public function giohang(Request $request){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('pages.cart.cart-ajax')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart'); //tạo session cart để kiểm tra
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key=>$value){
                if($value['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id'=>$session_id,
                    'product_id'=>$data['cart_product_id'],
                    'product_name'=> $data['cart_product_name'],
                    'product_image'=> $data['cart_product_image'],
                    'product_price'=> $data['cart_product_price'],
                    'product_qty'=> $data['cart_product_qty']
                );
                Session::put('cart', $cart);
            }
        }
        else{
            $cart[] = array(
                'session_id'=>$session_id,
                'product_id'=>$data['cart_product_id'],
                'product_name'=> $data['cart_product_name'],
                'product_image'=> $data['cart_product_image'],
                'product_price'=> $data['cart_product_price'],
                'product_qty'=> $data['cart_product_qty']
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }

    public function add_to_cart(Request $request){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $productId = $request->product_id_hidden;
        $quantity = $request->quantity;
        $product_info=DB::table('tbl_products')->where('product_id',$productId)->first();
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();
        $data['id'] =  $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] =  $product_info->product_name;
        $data['price'] =  $product_info->product_price;
        $data['weight'] =  $product_info->product_price;
        $data['options']['image'] =  $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10);
        return Redirect::to('cart-product');
        // Cart::destroy();
    }
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('pages.cart.cart-product')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('cart-product');
    }
    public function delete_product($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key=>$val){
                if($val['session_id']==$session_id) //nếu session_id của cart = $session_id truyền vào thì unset key vị trí của id sản phẩm đó trong giỏ hàng
                {
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Cập nhật giỏ hàng thành công!');
        }
        else  {
            return Redirect()->back()->with('message','Xóa sản phẩm không thành công');
        }
    }
    public function delete_all_product(){
        $cart=Session::get('cart');
        if($cart==true){
            Session::forget('cart');
            return Redirect()->back()->with('message','Xóa sản phẩm không thành công');
        }
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $quantity = $request->cart_quantity;
        Cart::update($rowId,$quantity);
        return Redirect::to('cart-product');
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key=>$qty){
                foreach($cart as $session=>$val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty']=$qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message','Cập nhật giỏ hàng thành công!');
        }
        else{
            return Redirect()->back()->with('error','Cập nhật giỏ hàng không thành công!');
        }
    }
    public function payment_end(){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('pages.login-checkout.payment-end')->with('category',$cate_product)->with('brand',$brand_product);
    }
}
