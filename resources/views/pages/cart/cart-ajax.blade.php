@extends('welcome')
@section('content')

    <div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('trang-chu')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
		@if(session()->has('message'))
			<div class="alert alert-success">
				{{session()->get('message')}}
			</div>
		@elseif(session()->has('error'))
			<div class="alert alert-dannger">
				{{session()->get('error')}}
			</div>
		@endif
		<div class="table-responsive cart_info">
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
					@if(Session::get('cart')==true)
					<?php
						$total = 0;
					?>
                    @foreach(Session::get('cart') as $key=>$val);
					<?php
						$subtotal = $val['product_qty'] * $val['product_price'];
						$total += $subtotal;

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
									<input type="number"class="cart_quantity_input" style="width:40px; border: 2px solid #E6E4DF; margin:-5px 5px 0 0"  name="cart_qty[{{$val['session_id']}}]" value="{{$val['product_qty']}}"  min="1" >
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
					<tr>
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
									{{-- <li>Thuế <span>{{Cart::tax().''.'VND'}}</span></li> --}}
									<li>Thuế: <span></span></li>
									<li>Phí vận chuyển: <span>Free</span></li>
									{{-- <li>Thành tiền <span>{{Cart::total().''.'VND'}}</span></li> --}}
									<li>Thành tiền: <span>{{ number_format($total,0,',','.')}}VND</span></li>
								</ul>
							</td>
							
					</tr>
					@else
						<tr>
							<td colspan="5">
								@php
									echo 'Giỏ hàng trống';
								@endphp
							</td>
						</tr>
						
					@endif
                </tbody>
            </table>
		  </form>
        </div>
       
    </div>

@endsection