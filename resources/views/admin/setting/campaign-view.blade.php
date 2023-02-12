@extends('admin.layout.master.master')

@section('main-content')
<style>
.dropify-message {
    line-height: initial;
    font-size: 10px;
}
.dropify-message p {
    font-size: 18px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>First Banner</b></h5>
            </div>
            <div class="body">
               <form class="addlogo" enctype="multipart/form-data">
                    <input type="hidden" value="banner1" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file"  data-default-file="\storage\storeLogo\{{$banner1}}">
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
                <h5 class="card-title"><b>Second Banner</b></h5>
            </div>
            <div class="body">
               <form class="addlogo" enctype="multipart/form-data">
                    <input type="hidden" value="banner2" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file" data-default-file="\storage\storeLogo\{{$banner2}}">
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
                <h5 class="card-title"><b>Pop Up</b></h5>
            </div>
            <div class="body">
               <form class="addlogo" enctype="multipart/form-data">
                    <input type="hidden" value="popup" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file" data-default-file="\storage\storeLogo\{{$popup}}">
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
                <h5 class="card-title"><b>First Banner Link</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                    <input type="hidden" value="link1" name="logoType">
                    <input type="text" class="form-control" id="link1" name="file"  placeholder="First Banner Link" value="{{$link1? $link1->file:''}}" required>
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
                <h5 class="card-title"><b>Second Banner Link</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                    <input type="hidden" value="link2" name="logoType">
                    <input type="text" class="form-control" id="link2" name="file"  placeholder="Second Banner Link" value="{{$link2? $link2->file:''}}" required>
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        $( ".addlogo" ).submit(function( event ) {
            event.preventDefault();
            let formData = new FormData()
            let logoType = $(this).find("input[name=logoType]").val();
            let file = $(this).find("input[name=file]")[0].files[0];

            formData.append('logoType', logoType);
            formData.append('file', file);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                type: "POST",
                url: "/admin/setting/storeCampaign",
                data: formData,
                success: function(response){
                    console.log(response)
                    swal("Success", "Banner changed successfully","success")
                },
                error: function(error){
                    console.log(error)
                    alert("can not change");
                }
            });
        });
        
        $( ".addtext" ).submit(function( event ) {
            event.preventDefault();
            let formData = new FormData()
            let logoType = $(this).find("input[name=logoType]").val();
            let file = $(this).find("input[name=file]").val();

            formData.append('logoType', logoType);
            formData.append('file', file);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                type: "POST",
                url: "/admin/setting/storeBannerLink",
                data: formData,
                success: function(response){
                    console.log(response)
                    swal("Success", "Link changed successfully","success")
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

 
@endsection
