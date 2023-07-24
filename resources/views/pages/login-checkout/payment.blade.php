@extends('welcome')
@section('content')

    <div >
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('trang-chu')}}">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
              </ol>
        </div><!--/breadcrums-->
        <div class="register-req">
            <p>Hãy đăng ký hoặc để thanh toán sản phẩm và tra cứu lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-8 clearfix">
                    <div class="bill-to">
                        <p>Thông tin nhận hàng</p>
                        <div class="form-one">
                            <form action="{{URL::to('info-payment-product')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" name="shipping_name" style="width:500px; margin-bottom:20px" placeholder="Họ và tên">
                                <input type="email" name="shipping_email" style="width:500px; margin-bottom:20px" placeholder="Email">
                                <input type="text" name="shipping_phone" style="width:500px; margin-bottom:20px" placeholder="Số điện thoại">
                                <input type="text" name="shipping_address" style="width:500px; margin-bottom:20px" placeholder="Địa chỉ">
                                <textarea  name="shipping_note"  placeholder="Ghi chú đơn hàng" rows="16"></textarea>
                                <input type="submit" value="Thanh toán" style="width:200px; margin-left:-1px" class="btn btn-primary check_out">
                            </form>
                        </div>
                    </div>
                </div>				
            </div>
        </div>
        <div class="review-payment">
            <h2>Danh sách sản phẩm</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead style="background: #FE980F; color:aliceblue; font-size:16px;">
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    
                </thead>
                <tbody>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/one.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>$59</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>$61</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
<!--/#cart_items-->

@endsection