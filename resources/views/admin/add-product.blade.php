@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mới sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php

                    use Illuminate\Support\Facades\Session;

                    $message =     Session::get('message');
                    if ($message) {
                        echo '<p class="text-center text-danger">', $message . '</p>';
                        Session::put('message', null);
                    }

                    ?>
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" id="ckeditor2" data-validation="length" data-validation-length="min10" data-validation-error-msg="không được để trống" class="form-control" name="product_name"  placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Danh mục sản phẩm</label>
                            
                            <select name="cate_product" class="form-control" id="exampleInputEmail2">
                            @foreach($cate_product as $key =>$cate)    
                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Thương hiệu sản phẩm</label>
                            
                            <select name="brand_product" class="form-control" id="exampleInputEmail3">
                            @foreach($brand_product as $key =>$brand)    
                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword6">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail5">Giá sản phẩm</label>
                            <input type="number" class="form-control" name="product_price" id="exampleInputEmail5" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail4">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" name="product_image" id="exampleInputEmail4" >
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">trạng thái</label>
                            <select class="form-control input-sm m-bot15" name="product_status">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>

                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection