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
<script src="{{asset('../backend/assets/vendor/jquery/jquery.min.js')}}"></script>


<div class="card">
    <div class="card-body">
        <form class="addFooter">
            {{-- <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Footer Heading *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="input-field" name="footer" required="" placeholder="Footer Text *">{{$data ?$data->footer:''}}</textarea>
                    </div>
                </div>
            </div> --}}
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Address Details *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="form-control summernote" name="copyright" required="" rows="10"  placeholder="Copyright Text *">{{$data ?$data->copyright:''}}</textarea>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Contact number *
                            
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <input class="form-control my-3" name="phone" required value="{{$data->site_number}}">
                    </div>
                </div>
            </div>
            
            
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Copyright *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="summernote" name="copy" required="" placeholder="copyright Text *">{{$data?$data->cotact:''}}</textarea>
                    </div>
                </div>
            </div>
            <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $( ".addFooter" ).submit(function( event ) {
            
            event.preventDefault();
            let formData = new FormData()
            let footer = $(this).find("textarea[name=footer]").val();
            // console.log(footer)
            
            let copyright = $(this).find("textarea[name=copyright]").val();
            let copy = $(this).find("textarea[name=copy]").val();
            let phone = $(this).find("input[name=phone]").val();

            formData.append('footer', footer);
            formData.append('copyright', copyright);
            formData.append('copy', copy);
            formData.append('phone', phone);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                
                type: "POST",
                url: "/admin/setting/storeFooter",
                data: formData,
                success: function(response){
                    console.log(response)
                    swal("Success", "Changed successfully","success")
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
    <!--<script src="{{asset('/backend/assets/bundles/mainscripts.bundle.js')}}"></script>-->
    <script src="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script>
        $('.summernote').summernote({
            placeholder: 'text',
            tabsize: 1,
            height: 220,
        });
    </script>
@endsection
