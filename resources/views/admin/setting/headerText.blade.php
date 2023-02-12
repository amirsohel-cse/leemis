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
<!-- <div class="card">
    <div class="card-body">
        <form class="addHeaderText">
            
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="left-area">
                        <h4 class="heading">
                            Header Text *
                            <p class="sub-heading">(In Any Language)</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tawk-area">
                        <textarea class="summernote" name="headerText" required=""  placeholder="Contact Text *"></textarea>
                        
                    </div>
                </div>
            </div>                          
            <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
        </form>
    </div>
</div> -->
<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Secure Payment</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                    <input type="hidden" value="left1" name="textType">
                    <input type="text" class="form-control" id="headerText" name="file"  placeholder="Header Left First" value="{{$left1}}" required>
                    
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Money Back Guaranty</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                    <input type="hidden" value="left2" name="textType">
                    <input type="text" class="form-control" id="headerText" name="file"  placeholder="Header Left Second" value="{{$left2}}" required>
                    
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Customer Support</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                    <input type="hidden" value="right" name="textType">
                    <input type="text" class="form-control" id="headerText" name="file"  placeholder="Header Right" value="{{$right}}" required>
                    
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>
    
    
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Delivery</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                    <input type="hidden" value="right2" name="textType">
                    <input type="text" class="form-control" id="headerText" name="file"  placeholder="Header Right" value="{{$right2}}" required>
                    
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>



</div>

@endsection

@section('page-stylesheet')

@endsection

@section('page-scripts')

    <!--<script src="{{asset('/backend/js/category.js')}}"></script>-->
    <!--<script src="{{asset('/backend/assets/bundles/mainscripts.bundle.js')}}"></script>-->
    <script src="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script>
        $('.summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 1,
            height: 220
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
      
        $( ".addtext" ).submit(function( event ) {
            event.preventDefault();
            let formData = new FormData()
            let type = $(this).find("input[name=textType]").val();
            let file = $(this).find("input[name=file]").val();

            formData.append('type', type);
            formData.append('text', file);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                type: "POST",
                url:  "/admin/setting/addHeaderText",
                data: formData,
                success: function(response){
                    console.log(response)
                    swal("Success", "Text changed successfully","success")
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
