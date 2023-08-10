@extends('welcome')
@section('content')


   
        <div class="row">    		
            <div class="col-sm-12">    			   			
                <h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
              
            </div>			 		
        </div>   
        <div class="row">  	
            <div class="col-sm-12">
                <?php

                use Illuminate\Support\Facades\Session;

                $message =     Session::get('message');
                if ($message) {
                    echo '<div class="alert alert-success">', $message . '</div>';
                    Session::put('message', null);
                }
                ?>
                <div class="contact-form">
                    <form id="main-contact-form" class="contact-form row" name="contact-form" action="{{URL::to('/send-blog')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group col-md-6">
                            <label for="">Tên tác giả</label>
                            <input type="text" name="customer_name" class="form-control" required="required" placeholder="Tên tác giả">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email tác giả</label>
                            <input type="email" name="customer_email" id="email" class="form-control" required="required" placeholder="Subject">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="title">Tên Blog</label>
                            <input type="text" id="title" name="title" class="form-control" required="required" placeholder="Name">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="ckeditor3">Nội dung</label>
                            <textarea name="content"  required="required" class="form-control" rows="8"   placeholder="Your Message Here"></textarea>
                        </div>                        
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
             			
        </div>  
    	

@endsection


