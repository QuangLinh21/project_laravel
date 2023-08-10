@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
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
                    <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>

                            <input type="text" class="form-control" required="required" name="brand_product_name" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea class="form-control" required="required" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="brand_product_status">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>

                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection