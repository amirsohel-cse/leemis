@extends('frontend.master.master')

@section('content')

<head>
    <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
</head>
<main class="mains checkouts">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-navs">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="/">Home</a></li>
                <li class="active text-capitalize"><a href="#">Most Recent Blog</a></li>
            </ul>
        </div>
    </nav>
</main>

<div class="container">
   
    <div class="row mb-5">

        @forelse ($blog as $b)
         <div class="col-lg-4 col-md-6 mb-2-6">
            <article class="card card-style2">
                <div class="card-img">
                    <img class="rounded-top" src="{{asset('uploads/blogs/'.$b->image)}}" alt="...">
                    <div class="date"></div>
                </div>
                <div class="card-body">
                    <h3 class="h5 text-uppercase"><a href="{{route('viewblog',$b->id)}}"><h4>{{$b->title}}</h4></a></h3>
                    <p class="">  {!! Str::limit($b->details, 100) !!}</p>
                    <a href="{{route('viewblog',$b->id)}}" class="read-more text-capitalize">read more</a>
                </div>
                <div class="card-footer">
                    <ul>

                        <li><a href="#!"><i class="far fa-clock"></i><span>{{$b->created_at->format('d-m-Y')}}</span></a></li>
                    </ul>
                </div>
            </article>
        </div>

        @empty

        @endforelse

    </div>


</div>












<style>

.card-style2 {
    position: relative;
    display: flex;
    transition: all 300ms ease;
    border: 1px solid rgba(0, 0, 0, 0.09);
    padding: 0;
    height: 100%;
}
.card-style2 .card-img {
    position: relative;
    display: block;
    background: #ffffff;
    overflow: hidden;
    border-radius: 0.25rem;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
.card-style2 .card-img img {
    transition: all 0.3s linear 0s;
}
.card-style2:hover .card-img img {
    transform: scale(1.05);
}
.card-style2 .date {
    position: absolute;
    right: 30px;
    top: 30px;
    z-index: 1;
    color: #16bae1;
    overflow: hidden;
    padding-bottom: 10px;
    line-height: 24px;
    text-align: center;
    border: 2px solid #ededed;
    display: inline-block;
    background-color: #ffffff;
    text-transform: uppercase;
    border-radius: 0.25rem;
}
.card-style2 .date span {
    position: relative;
    color: #ffffff;
    font-weight: 500;
    font-size: 20px;
    display: block;
    text-align: center;
    padding: 12px;
    margin-bottom: 10px;
    background-color: #00baee;
    border-radius: 0.25rem;
}
.card-style2 .card-body {
    position: relative;
    display: block;
    background: #ffffff;
    padding: 2rem;
}
.card-style2 .card-body h3 {
    margin-bottom: 0.8rem;
}
.card-style2 .card-body h3 a {
    color: #004975;
}
.card-style2 .card-body h3 a:hover {
    color: #00baee;
}
.card-style2 .card-footer {
    border-top: 1px solid rgba(0, 0, 0, 0.09);
    background: transparent;
    padding-right: 2rem;
    padding-left: 2rem;
    -ms-flex-align: end;
    align-items: flex-end;
}
.card-style2 .card-footer ul {
    display: flex;
    justify-content: space-between;
    list-style: none;
    margin-bottom: 0;
}
.card-style2 .card-footer ul li {
    font-size: 15px;
}
.card-style2 .card-footer ul li a {
    color: #394952;
}
.card-style2 .card-footer ul li a:hover {
    color: #00baee;
}
.card-style2 .card-footer ul li i {
    color: #00baee;
    font-size: 14px;
    margin-right: 8px;
}
</style>

@endsection
