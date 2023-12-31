@extends('welcome')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>ĐĂNG NHẬP</h2>
                    <form action="{{URL::to('login-customer')}}" method="post">
                        {{ csrf_field() }}
                        <input type="email" name="username" required="required" placeholder="User name" />
                        <input type="password" name="password" required="required" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>ĐĂNG KÝ TÀI KHOẢN!</h2>
                    <form action="{{URL::to('add-customer')}}" method="post">
                        {{ csrf_field() }}
                        <input type="text" name="customer_name" required="required" placeholder="Họ và tên"/>
                        <input type="email" name="customer_email" required="required" placeholder="Email"/>
                        <input type="password" name="customer_password" required="required" placeholder="Mật khẩu"/>
                        <input type="text" name="customer_phone" required="required" placeholder="SDT"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection