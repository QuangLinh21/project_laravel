@extends('welcome')
@section('content')

<div class="features_items">
    <h2 class="title text-center">KẾT QUẢ TÌM KIẾM</h2>
    @foreach ($search_product as $key=>$item)
        
    
    <div class="col-sm-4">
        <div class="product-image-wrapper" >
            <div class="single-products "  >
                <div class="productinfo text-center" >
                    <img src="{{URL::to('../public/uploads/product/'.$item->product_image)}}" width="190px" height="260px" alt="" />
                    <h2>{{ number_format($item->product_price).' '.'VND' }}</h2>
                    <p>
                        {{$item->product_name}}  </p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{ number_format($item->product_price).' '.'VND' }}</h2>
                        <p>{{$item->product_name}}</p>
                        <a href="{{URL::to('product-details/'.$item->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
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