@extends('frontend.master.master')
@section('content')

<head>
    <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
</head>

<nav class="breadcrumb-navs">
    <div class="container">
        <ul class="breadcrumb shop-breadcrumb bb-no">
            <li class="passed"><a href="/">{{languageChange('Home')}}</a></li>
            <li class="active"><a href="#">{{languageChange('Terms And Condition')}}</a></li>
        </ul>
    </div>
</nav>

<div class="container pb-5">
    <!-- <div class="row">
        <div class="col-md-12">
            <p><?php echo @$terms->terms ?></p>
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Have an Question? <br> Please Contact Us</h3>
            <form class="contact-form">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label>Name</label>
                        <input type="text" name="#0" class="form-control" placeholder="Full Name">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label>Mobile Number</label>
                        <input type="tel" name="#0" class="form-control" placeholder="Mobile Number">
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label>Subject</label>
                        <input type="text" name="#0" class="form-control" placeholder="Subject">
                    </div>
                    <div class="col-lg-12">
                        <label>Message</label>
                        <textarea name="#0" class="form-control" rows="10" placeholder="Write Message"></textarea>
                        <!-- <textarea name="" id="" cols="30" ></textarea> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection