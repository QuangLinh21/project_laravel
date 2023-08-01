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
    </div>
<!--/#cart_items-->

@endsection