@extends('welcome')
@section('content')

<div class="features_items">
    <h2 class="title text-center">SẢN PHẨM </h2>
    @foreach ($all_product as $key=>$item)

    <div class="col-sm-4">
        <div class="product-image-wrapper" >
            <div class="single-products "  >
                    <input type="hidden" value="1" class="cart_product_qty_{{$item->product_id}}">
                    <div class="productinfo text-center" >
                        <img src="{{URL::to('../public/uploads/product/'.$item->product_image)}}" width="190px" height="260px" alt="" />
                        <h2>{{ number_format($item->product_price).' '.'VND' }}</h2>
                        <p>
                            {{$item->product_name}}  </p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                        {{-- <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$item->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button> --}}
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ number_format($item->product_price).' '.'VND' }}</h2>
                            <p>{{$item->product_name}}</p>
                            <a href="{{URL::to('product-details/'.$item->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                            {{-- <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$item->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button> --}}
                        </div>
                    </div>
              
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
        
    </div>
    @endforeach
   

</div>
@endsection


{{-- ------------------------------------------------------ --}}
{{-- @extends('welcome')
@section('content')

<div class="features_items">
    <h2 class="title text-center">SẢN PHẨM MỚI NHẤT</h2>
    @foreach ($all_product as $key=>$item)
        
    
    <div class="col-sm-4">
        <div class="product-image-wrapper" >
            <div class="single-products "  >
               <form>
                @csrf
                    <input type="hidden" value="{{$item->product_id}}" class="cart_product_id_{{$item->product_id}}">
                    <input type="hidden" value="{{$item->product_name}}" class="cart_product_name_{{$item->product_id}}">
                    <input type="hidden" value="{{$item->product_image}}" class="cart_product_image_{{$item->product_id}}">
                    <input type="hidden" value="{{$item->product_price}}" class="cart_product_price_{{$item->product_id}}">
                    <input type="hidden" value="1" class="cart_product_qty_{{$item->product_id}}">
                    <div class="productinfo text-center" >
                        <img src="{{URL::to('../public/uploads/product/'.$item->product_image)}}" width="190px" height="260px" alt="" />
                        <h2>{{ number_format($item->product_price).' '.'VND' }}</h2>
                        <p>
                            {{$item->product_name}}  </p>
                        {{-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> --}}
                        {{-- <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$item->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ number_format($item->product_price).' '.'VND' }}</h2>
                            <p>{{$item->product_name}}</p> --}}
                            {{-- <a href="{{URL::to('product-details/'.$item->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> --}}
                            {{-- <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$item->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                        </div>
                    </div>
               </form>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
        
    </div>
    @endforeach
   

</div>
@endsection --}} 