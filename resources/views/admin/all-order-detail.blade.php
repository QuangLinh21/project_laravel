@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách đơn hàng
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <?php

            use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
            if ($message) {
                echo '<p class="text-center text-danger">', $message . '</p>';
                Session::put('message', null);
            }

            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>ID hóa đơn</th>
                        <th>ID khách</th>
                        <th>ID ship</th>
                        <th>ID sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>thành tiền</th>
                        <th>SDT khách</th>
                        <th>Địa chỉ khách</th>
                        <th>Ghi chú khách</th>
                        <th colspan="2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_order_detail as $key=>$order)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox"><i></i></label></td>
                        <td>{{$order->order_details_id}}</td>
                        <td>{{$order->customer_id}}</td>
                        <td>{{$order->shipping_id}}</td>
                        <td>{{$order->product_id}}</td>
                        <td>{{$order->product_name}}</td>
                        <td>{{$order->product_quantity}}</td>
                        <td>{{ number_format($order->order_total ,0,',','.')}}</td>
                        <td>{{$order->ship_customer_phone}}</td>
                        <td>{{$order->ship_customer_address}}</td>
                        <td>{{$order->ship_customer_note}}</td>
                        <td>
                            <a href="{{URL::to('edit-order/'.$order->order_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                        </td>
                        <td>
                            <a href="{{URL::to('delete-order/'.$order->order_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Bạn có muốn xóa danh mục này không?')"><i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection