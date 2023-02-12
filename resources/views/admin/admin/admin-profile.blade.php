@extends('admin.layout.master.master')

@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1>Admin Profile</h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Admin</span> <i class="fa fa-angle-right"></i>
                <span>Profile</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">

                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                     
                    </ul>
                </div>
                <div class="body">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto mb-3">
                        @if(Auth::user()->role_id == '1')
                            <h6 class="text-center">Role : Admin</h6>
                        @elseif(Auth::user()->role_id == '2')
                            <h6 class="text-center">Role : Moderator</h6>
                        @else 
                            <h6 class="text-center">Role : Editor</h6>
                        @endif
                        <form action="" id="edit-admin-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="edit-shop-name" class="col-sm-3 col-form-label"><strong>Admin Name</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-name" type="text" class="form-control" name="name"  placeholder="Enter shop name" value="{{old('name',$admin->name)}}">
                                    </div>
                            </div>
                       
                            <strong><span id="edit_name_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            <div class="form-group row">
                                <label for="edit-email" class="col-sm-3 col-form-label"><strong>Email</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-email" type="email" class="form-control" name="email"  value="{{old('email',$admin->email)}}" readonly>
                                    </div>
                            </div>
                       
                            <strong><span id="edit_email_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            <div class="form-group row">
                                <label for="edit-phone" class="col-sm-3 col-form-label"><strong>Phone</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-phone" type="text" class="form-control" name="phone"  value="{{old('phone',$admin->phone)}}" >
                                    </div>
                            </div>
                       
                            <strong><span id="edit_phone_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            <div class="form-group row">
                                <label for="edit-password" class="col-sm-3 col-form-label"><strong>Password</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-password" type="password" class="form-control" name="password"  >
                                    </div>
                            </div>
                     
                            <strong><span id="edit_password_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            <div class="form-group row">
                                <label for="eid="edit-password_confirmation"" class="col-sm-3 col-form-label"><strong>Confirm Password</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-password_confirmation" type="password" class="form-control" name="password_confirmation" >
                                    </div>
                            </div>
                       
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"> Image</span>
                                        </div>
                                        <input id="edit-image" type="file" name="image" data-allowed-file-extensions="png jpg jpeg" class="dropify edit-photo" >
                                    </div> 
                                    <strong><span id="edit_image_error" class="invalid-feedback d-block mb-3" role="alert">
                                    </span> </strong>
                                </div>
                                <div class="col-6">
                                    @if(!empty($admin->image))
                                        <img width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="{{ asset('uploads/admins/'.$admin->image) }}" alt="">
                                    @else
                                        <img hidden width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="" alt="">
                                    @endif

                                </div>
                            </div>                 

                            <button type="submit" class="btn btn-primary theme-bg gradient">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-stylesheet')
    <link rel="stylesheet" href="{{asset('/backend/assets/css/nice-select.css')}}">

@endsection
@section('page-scripts')
    <script src="{{asset('/backend/assets/js/jquery.nice-select.js')}}"></script>
    <script !src="">
        $(document).ready(function () {
            $('select').niceSelect();
        });
    </script>
    <script src="{{asset('/backend/js/admin-profile.js')}}"></script>

@endsection

            