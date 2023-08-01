@extends('welcome')
@section('content')

    <div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('trang-chu')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
         
		<div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
                // print_r($content);
                
            ?>
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
                </tbody>
            </table>
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
							<li>Tổng tiền <span>{{Cart::priceTotal(0,',','.').''.'VND'}}</span></li>
							{{-- <li>Thuế <span>{{Cart::tax().''.'VND'}}</span></li> --}}
                            <li>Thuế <span>{{Cart::tax(0,',','.').''.'VND'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							{{-- <li>Thành tiền <span>{{Cart::total().''.'VND'}}</span></li> --}}
                            <li>Thành tiền <span>{{Cart::total(0,',','.').''.'VND'}}</span></li>
						</ul>
							{{-- <a class="btn btn-default update" href="">Cập nhật</a> --}}
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
									
					</div>
				</div>
			</div>
		</div>
    </div>

@endsection