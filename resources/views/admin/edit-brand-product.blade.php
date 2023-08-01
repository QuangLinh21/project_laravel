@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thay đổi danh mục sản phẩm
            </header>
            <div class="panel-body">
                @foreach($edit_brand as $key=>$edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('update-brand-product/'.$edit_value->brand_id)}}" method="post">
                        {{csrf_field()}}
                   
                            
                        <div class="form-group">
                        <label for="exampleInputPassword1" >Tên thương hiệu</label>
                            <input type="text" class="form-control " value="{{$edit_value->brand_name}}" name="brand_product_name" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="mb-3">Mô tả thương hiệu</label>
                            <textarea class="form-control" name="brand_product_desc" id="exampleInputPassword1" >{{$edit_value->brand_desc}}</textarea>
                        </div>
                        <button type="submit" name="update_brand_product" class="btn btn-info">Update</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection