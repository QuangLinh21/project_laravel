@extends('welcome')
@section('content')

<div class="blog-post-area">
    <h2 class="title text-center">Blog</h2>
    <div class="single-blog-post">
        @foreach ($full_blog as $key=>$item)
            
      
        <h3>{{$item->title}}</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i>{{$item->customer_name}}</li>
                <li><i class="fa fa-clock-o"></i>{{$item->time}}</li>
                <li><i class="fa fa-calendar"></i> {{$item->date}}</li>
            </ul>
            <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
            </span>
        </div>
        <a href="">
            <img src="images/blog/blog-one.jpg" alt="">
        </a>
        <p>{{$item->content}}</p>
        <a  class="btn btn-primary" href="{{URL::to('/blog')}}"> Back to</a>
        @endforeach
    </div>
   
    <div class="pagination-area">
        <ul class="pagination">
            <li><a href="" class="active">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
        </ul>
    </div>
</div>
@endsection


