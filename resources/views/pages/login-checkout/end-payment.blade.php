@extends('welcome')
@section('content')
<?php
?>
    <div >
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('trang-chu')}}">Trang chủ</a></li>
                <li class="active">Thanh toán đơn hàng</li>
              </ol>
        </div><!--/breadcrums-->
        <div class="review-payment">
            <h2>Thông tin nhận hàng || <a class="btn btn-primary" href="{{URL::to('payment')}}" style=" margin-top:0px">Thêm thông tin nhận hàng</a></h2>
            <ul>
                @foreach($info_shipping as $key=>$value)
                <li>
                    <a href="{{URL::to('delete-address-ship/'.$value->shipping_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Bạn có muốn xóa danh mục này không?')"><i class="fa fa-times text-danger text"></i></a>
                    <input type="radio" name="chose_adress_shipping" value="{{$value->shipping_id}}" id=""><span>{{$value->customer_name}}</span>&nbsp;<span>sdt: {{$value->ship_customer_phone}}</span>&nbsp;<span>Địa chỉ: {{$value->ship_customer_address}}
                    </span>&nbsp; 
                </li>
           
            @endforeach
            </ul>
      
        
        </div>
        <div class="review-payment">
            <h2>Danh sách sản phẩm</h2>
        </div>

        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
            // print_r($content);
            
        ?>
             <form action="{{URL::to('/update-cart')}}" method="post">
                @csrf
                <table class="table table-condensed">
                    <thead style="background: #FE980F; color:aliceblue; font-size:16px;">
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td>Tên sản phẩm</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php
                            $total = 0;
                           
                        ?>
                        @foreach(Session::get('cart') as $key=>$val);
                        <?php
                            $subtotal = $val['product_qty'] * $val['product_price'];
                            $total += $subtotal;
                            Session::put('total',$total);
    
                        ?>
                        <tr>
                            <td class="cart_image">
                                <img src="{{URL::to('../public/uploads/product/'.$val['product_image'])}}" width="90px" height="120px" alt="" />
                            </td>
                            <td class="cart_name">
                                <h4>{{$val['product_name']}}</h4>
                                <p>Web ID:{{$val['product_id']}} </p>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($val['product_price'],0,',','.')}}VND</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">          
                                        <input type="text"class="cart_quantity_input" style="width:40px; border: 2px solid #E6E4DF; margin:-5px 5px 0 0"  name="cart_qty[{{$val['session_id']}}]" value="{{$val['product_qty']}}"  min="1" >
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{ number_format($subtotal,0,',','.')}}VND
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete"  href="{{URL::to('delete-product-cart/'.$val['session_id'])}}" ><i class="fa fa-times" style="margin-top:50px;"></i></a>
                            </td>
                        </tr>
                        
                        @endforeach
                        {{-- <tr>
                            <td>
                                <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out">
                            </td>
                            <td>
                                <a href="{{URL::to('/delete-all-product')}}"  name="update_qty" class="btn btn-default check_out">Xóa tất cả sản phẩm</a>
                            </td>
                            <td>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id==null){
                                        ?>
                                    <a class="btn btn-default check_out" href="{{URL::to('login-checkout')}}">Đăng nhập</a>
                                    <?php
                                } else {?>
                                    <a class="btn btn-default check_out" href="{{URL::to('end-payment')}}">Thanh toán</a>
                                    <?php
                                    }
                                    ?>
                            </td>
                                <td colspan="2">
                                    <ul style="margin-bottom: 30px">
                                        <li>Tổng tiền: <span> {{ number_format($total,0,',','.')}}VND</span></li>
                                        <li>Thuế <span>{{Cart::tax().''.'VND'}}</span></li>
                                        <li>Thuế: <span></span></li>
                                        <li>Phí vận chuyển: <span>Free</span></li>
                                        <li>Thành tiền <span>{{Cart::total().''.'VND'}}</span></li>
                                        <li>Thành tiền: <span>{{ number_format($total,0,',','.')}}VND</span></li>
                                    </ul>
                                </td>
                                
                        </tr> --}}
                      
                    </tbody>
                </table>
              </form>
        </div>
        <hr>
        <div>
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row" style="margin-bottom: 30px">
				<div class="col-sm-6">
					<div class="chose_area" style="border: 1px solid #E6E4DF; padding: 10px">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area" style="border: 1px solid #E6E4DF; padding: 32px 25px 10px 2px">
                            <ul style="margin-bottom: 30px">
                                <li>Tổng tiền: <span> {{ number_format($total,0,',','.')}}VND</span></li>
                                {{-- <li>Thuế <span>{{Cart::tax().''.'VND'}}</span></li> --}}
                                <li>Thuế: <span></span></li>
                                <li>Phí vận chuyển: <span>Free</span></li>
                                {{-- <li>Thành tiền <span>{{Cart::total().''.'VND'}}</span></li> --}}
                                <li>Thành tiền: <span>{{ number_format($total,0,',','.')}}VND</span></li>
                            </ul>		
					</div>
				</div>
			</div>
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
                <?php
									$shipping_id = Session::get('shipping_id');
									if($shipping_id==null){
										?>
									<a class="btn btn-default check_out" href="{{URL::to('payment')}}">Điền thông tin nhận hàng</a>
									<?php
									}else {?>
									 <input type="submit" value="Đặt hàng" style=" margin-top:0px" class="btn btn-primary check_out">
									<?php
									}
									?>

               
              </form>
            </div>
    </div>
<!--/#cart_items-->

@endsection