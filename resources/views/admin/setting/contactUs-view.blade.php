@extends('admin.layout.master.master')

@section('main-content')
<link rel="stylesheet" href="{{asset('/backend/assets/vendor/summernote/dist/summernote.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.css')}}">
<style type="text/css">
textarea.input-field
{  
    width: 100%;
    height: 150px;
    /* border-color: Transparent;      */
}
.left-area {
    text-align: right;
}
.left-area .heading {
    font-size: 16px!important;
    font-weight: 600;
    color: #0d3359;
    margin-bottom: 0px;
    font-family: "Open Sans", sans-serif;
    line-height: 1.2380952380952381;
}
.left-area .sub-heading {
    font-size: 12px;
    color: #143250;
}
.left-area p {
    margin-bottom: 0px;
    font-size: 16px;
    color: #465541;
    line-height: 1.625;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    font-family: "Open Sans", sans-serif;
    hyphens: auto;
}
</style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<div class="card">
    <div class="card-body">
        <form class="addContacts">
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Contact Title *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="summernote" name="contactTitle" required=""  placeholder="Contact Title *">{{$data?$data->contact_title:''}}</textarea>
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Contact Text *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="summernote" name="contactText" required=""  placeholder="Contact Text *">{{$data?$data->contact_text:''}}</textarea>
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Contact Us Email Address *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="input-field" name="contactEmail" required=""  placeholder="Contact Us Email Address *">{{$data?$data->contact_email:''}}</textarea>
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Contact Form Success Text *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="input-field" name="contactFormSuccess" required=""  placeholder="Contact Form Success Text *">{{$data?$data->contact_success_text:''}}</textarea>
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Email *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                    <input type="email" class="input-field" placeholder="Email *" name="email" value="{{$data?$data->email:''}}">
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Website *

                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                    <input type="text" class="input-field" placeholder="Website *" name="website" value="{{$data?$data->website:''}}">
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Street Address *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="input-field" name="streetAddress" required=""  placeholder="Street Address *">{{$data?$data->street:''}}</textarea>
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Phone *

                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                    <input type="text" class="input-field" placeholder="Phone *" name="phone" value="{{$data?$data->phone:''}}">
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Fax *

                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                    <input type="text" class="input-field" placeholder="Fax *" name="fax" value="{{$data?$data->fax:''}}">
                        
                    </div>
                </div>
            </div>
            <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $( ".addContacts" ).submit(function( event ) {
            
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                
                type: "POST",
                url: "/admin/setting/storeContacts",
                data: new FormData(this),
                success: function(response){
                    console.log(response)
                    swal("Success", "Stored successfully","success")
                },
                error: function(error){
                    console.log(error)
                    alert("can not change");
                }
            });
        });
    });
</script>
@endsection

@section('page-stylesheet')

@endsection

@section('page-scripts')

    <script src="{{asset('/backend/js/category.js')}}"></script>
    <script src="{{asset('/backend/assets/bundles/mainscripts.bundle.js')}}"></script>
    <script src="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script>
        $('.summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 1,
            height: 220
        });
    </script>
@endsection
