@extends('welcome')
@section('content')

    <div >
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('trang-chu')}}">Trang chủ</a></li>
                <li class="active">Thanh toán đơn hàng</li>
              </ol>
        </div><!--/breadcrums-->
        <div class="review-payment">
            <h2>Danh sách sản phẩm</h2>
        </div>

        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
            // print_r($content);
            
        ?>
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
                    @foreach ($content as $v_content)
                    <tr>
                        <td class="cart_image">
                            <a href=""><img src="{{URL::to('../public/uploads/product/'.$v_content->options->image)}}" width="90px" height="120px" alt="" /></a>
                        </td>
                        <td class="cart_name">
                            <h4>{{$v_content->name}}</h4>
                            <p>Web ID: {{$v_content->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($v_content->price).''.'VND'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                               <form action="{{URL::to('update-cart-quantity')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="number"class="cart_quantity_input" style="width:40px; border: 2px solid #E6E4DF; margin:-5px 5px 0 0"  name="cart_quantity" value="{{$v_content->qty}}"  min="1" >
                                {{-- <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}"  min="1" size="2"> --}}
                                <input type="hidden" name="rowId_cart" id="" class="" value="{{$v_content->rowId}}">
                                <input type="submit" value="Update" name="update_qty" class="btn btn-default btn-sm" style="width:60px; border: 2px solid #E6E4DF; margin:-7px 5px 0 0">
                            </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $priceTotal = $v_content->price * $v_content->qty;
                                    echo number_format($priceTotal).''.'VND';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"  href="{{URL::to('delete-to-cart/'.$v_content->rowId)}}" ><i class="fa fa-times" style="margin-top:50px; " ></i></a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td>{{Cart::priceTotal(0,',','.').''.'VND'}}</td>
                                </tr>
                                <tr>
                                    <td>Thuế</td>
                                    <td>{{Cart::tax(0,',','.').''.'VND'}}</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Phí vận chuyển</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Thành tiền</td>
                                    <td><span>{{Cart::total(0,',','.').''.'VND'}}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payment-options">
            <h5 style="margin-top:30px;">Chọn hình thức thanh toán</h5>
              <form action="{{URL::to('oder-product')}}" method="post">
                {{ csrf_field() }}
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Thanh toán thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Thanh toán trực tiếp</label>
                </span>
                <input type="submit" value="Đặt hàng" style=" margin-top:0px" class="btn btn-primary check_out">
              </form>
            </div>
    </div>
<!--/#cart_items-->

@endsection