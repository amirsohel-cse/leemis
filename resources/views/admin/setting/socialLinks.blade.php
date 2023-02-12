@extends('admin.layout.master.master')
@section('main-content')
<style>
    .social-links-area input:checked + .slider {
        background-color: #2d3274;
    }
</style>
<script src="{{asset('../backend/assets/vendor/jquery/jquery.min.js')}}"></script>

<div class="card social-links-area mt-5">
    <div class="card-body">
        <form class="socialLinks">
            <div class="row">
                <label class="control-label col-sm-3 text-primary" for="facebook">Facebook *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="facebook" id="facebook" placeholder="http://facebook.com/" required="" type="text" value="{{$data->facebook ?? 'http://facebook.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="f_status" value="f_status" {{($data && $data->f_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            {{-- <div class="row">
                <label class="control-label col-sm-3 text-danger" for="gplus">Google Plus*</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="gplus" id="gplus" placeholder="http://google.com/" required="" type="text"value="{{$data->google ?? 'http://google.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="g_status" value="g_status" {{($data && $data->g_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                     </label>
                </div>
            </div> --}}

            <div class="row">
                <label class="control-label col-sm-3 text-danger" for="twitter">Youtube *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="twitter" id="twitter" placeholder="http://youtube.com/" required="" type="text" value="{{$data->twitter ?? 'http://youtube.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="t_status" value="t_status" {{($data && $data->t_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <div class="row">
                <label class="control-label col-sm-3" style="color:#aa0909" for="linkedin">Instagram *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="linkedin" id="linkedin" placeholder="http://instagram.com/" required="" type="text"value="{{$data->linkedin ?? 'http://instagram.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="l_status" value="l_status" {{($data && $data->l_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <div class="row">
                <label class="control-label col-sm-3" style="color:#2695f0" for="dribble">Twitter *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="dribble" id="dribble" placeholder="https://twitter.com/" required="" type="text" value="{{$data->dribble ?? 'https://twitter.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="d_status" value="d_status" {{($data && $data->d_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            
            
            <div class="row">
                <label class="control-label col-sm-3" style="color:#2695f0" for="dribble">Snapchat *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="snapchat" id="snapchat" placeholder="https://Snapchat.com/" required="" type="text" value="{{$data->snapchat ?? 'https://snapchat.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="snap_status" value="snap_status" {{($data && $data->snap_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            
            
            <div class="row">
                <label class="control-label col-sm-3" style="color:#2695f0" for="dribble">Linkedin *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="link" id="link" placeholder="https://linkedin.com/" required="" type="text" value="{{$data->linkedin ?? 'https://linkedin.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="link_status" value="link_status" {{($data && $data->link_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            
            
            <div class="row">
                <label class="control-label col-sm-3" style="color:#2695f0" for="dribble">Tiktok *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="tiktok" placeholder="https://tiktok.com/" required="" type="text" value="{{$data->tiktok ?? 'https://tiktok.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="tiktok_status" value="tiktok_status" {{($data && $data->tiktok_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            
            
            
            <div class="row">
                <label class="control-label col-sm-3" style="color:#2695f0" for="dribble">Pinterest *</label>
                <div class="col-sm-6">
                    <input class="form-control m-b-10" name="pinterest" placeholder="https://pinterest.com/" required="" type="text" value="{{$data->pinterest ?? 'https://pinterest.com/'}}">
                </div>
                <div class="col-sm-3">
                    <label class="switch">
                        <input type="checkbox" name="pinterest_status" value="pinterest_status" {{($data && $data->pinterest_status)?'checked':'unchecked'}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary theme-bg gradient">Save</button>
                </div>
             </div>
    


        </form>

    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        $( ".socialLinks" ).submit(function( event ) {
            
            event.preventDefault();
            let formData = new FormData()
            let facebook = $(this).find("input[name=facebook]").val();
            let f_status=$(this).find("input[name=f_status]").is(':checked')?1:0;
            let google = $(this).find("input[name=gplus]").val();
            let g_status=$(this).find("input[name=g_status]").is(':checked')?1:0;
            let twitter = $(this).find("input[name=twitter]").val();
            let t_status=$(this).find("input[name=t_status]").is(':checked')?1:0;
            let linkedin = $(this).find("input[name=linkedin]").val();
            let l_status=$(this).find("input[name=l_status]").is(':checked')?1:0;
            let dribble = $(this).find("input[name=dribble]").val();
            let d_status=$(this).find("input[name=d_status]").is(':checked')?1:0;
            
            
            
             let tiktok = $(this).find("input[name=tiktok]").val();
            let tiktok_status=$(this).find("input[name=tiktok_status]").is(':checked')?1:0;
            
            
             let pinterest = $(this).find("input[name=pinterest]").val();
            let pinterest_status=$(this).find("input[name=pinterest_status]").is(':checked')?1:0;
            
             let snap = $(this).find("input[name=snapchat]").val();
             let snap_status=$(this).find("input[name=snap_status]").is(':checked')?1:0;
            
            
             let link = $(this).find("input[name=link]").val();
            let link_status=$(this).find("input[name=link_status]").is(':checked')?1:0;
            
            
            formData.append('facebook', facebook);
            formData.append('f_status', f_status);
            formData.append('google', google);
            formData.append('g_status', g_status);
            formData.append('twitter', twitter);
            formData.append('t_status', t_status);
            formData.append('linkedin', linkedin);
            formData.append('l_status', l_status);
            formData.append('dribble', dribble);
            formData.append('d_status', d_status);
            
            formData.append('snap', snap);
            formData.append('snap_status', snap_status);
            
             formData.append('link', link);
            formData.append('link_status', link_status);
            
            formData.append('tiktok', tiktok);
            formData.append('tiktok_status', tiktok_status);
            
            formData.append('pinterest', pinterest);
            formData.append('pinterest_status', pinterest_status);
            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                
                type: "POST",
                url: "/admin/social/socialLinksStore",
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

@endsection
