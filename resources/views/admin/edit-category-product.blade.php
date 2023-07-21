@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thay đổi danh mục sản phẩm
            </header>
            <div class="panel-body">
                @foreach($edit_category as $key=>$edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                        {{csrf_field()}} 
                        <div class="form-group">
                        <label for="exampleInputPassword1" >Tên danh mục</label>
                            <input type="text" class="form-control " value="{{$edit_value->category_name}}" name="category_product_name" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="mb-3">Mô tả danh mục</label>
                            <textarea class="form-control" name="category_product_desc" id="exampleInputPassword1" >{{$edit_value->category_name}}</textarea>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Update</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection