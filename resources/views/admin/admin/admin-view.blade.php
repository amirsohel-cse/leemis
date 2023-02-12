@extends('admin.layout.master.master')

@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Admin</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Admin</span> <i class="fa fa-angle-right"></i>
                <span>Admins</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">

                    <button class="btn btn-success btn-round" id="addAdminBtn" data-toggle="modal" data-target="#addAdminModal"><i class="fa fa-plus"></i> Add Admin</button>

                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                        <!--<li class="dropdown">-->
                        <!--    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>-->
                        <!--    <ul class="dropdown-menu theme-bg gradient">-->
                        <!--        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>-->
                        <!--        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>-->
                        <!--        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>-->
                        <!--        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>-->
                        <!--        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>-->
                        <!--        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Image</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Image</th>
                                <th>Options</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse($admins as $row)
                            <tr data-id="{{$row->id}}">
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                @if($row->role_id == '1')
                                    <td>Admin</td>
                                @elseif($row->role_id == '2')
                                    <td>Moderator</td>
                                @elseif($row->role_id == '3') 
                                    <td>Editor</td>
                                @else
                                    <td>Sub Admin</td>
                                @endif
                                <td>
                                    @if($row->image)
                                        <img style="width: 80px; height: 90px" src="{{asset('uploads/admins/'.$row->image) }}" alt="admin image">
                                    @endif
                                </td>
 
                                <td>
                                    <button data-id="{{$row->id}}" data-toggle="modal" data-target="#editAdminModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                                    <button data-id="{{$row->id}}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @empty
                                <td colspan="5" class="text-center">No data Available</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{--Add admin Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addAdminModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW ADMIN</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-admin-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Admin Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" aria-label="Default" placeholder="Enter Name" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <strong><span id="name_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Email*</strong></span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" aria-label="Default" placeholder="Enter Email" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <strong><span id="email_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Phone</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" aria-label="Default" aria-describedby="inputGroup-sizing-default" >
                                </div>
                                <strong><span id="phone_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Password*</strong></span>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Minimum 8 characters" aria-label="Default" placeholder="Minimum 8 characters" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <strong><span id="password_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Confirm Password*</strong></span>
                                    </div>
                                    <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" aria-label="Default" placeholder="Confirm password" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mr-4" id="inputGroup-sizing-default"><strong>Role</strong></span>
                                    </div>
                                    <label class="fancy-radio mt-1">
                                        <input id="role-admin" name="role_id" value="1" type="radio" checked>
                                        <span><i></i>Admin</span>
                                    </label>

                                    <label class="fancy-radio mt-1">
                                        <input id="role-moderator" name="role_id" value="2" type="radio">
                                        <span><i></i>Moderator</span>
                                    </label>

                                    <label class="fancy-radio mt-1">
                                        <input name="role_id" value="3" type="radio">
                                        <span><i></i>Editor</span>
                                    </label>

                                    <label class="fancy-radio mt-1">
                                        <input name="role_id" value="4" type="radio">
                                        <span><i></i>Sub Admin</span>
                                    </label>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong> Image </strong></span>
                                    </div>
                                    <input id="image" type="file" name="image" class="dropify photo" >
                                </div>        
                                <strong><span id="image_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>
                                <button type="submit" class="btn btn-primary theme-bg gradient">Save admin</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    {{--Add admin Modal ends--}}


    {{--Edit admin modal starts--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editAdminModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT ADMIN</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-admin-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    {{-- admin id input field --}}
                                    <input type="text" id="admin-id" name="id" hidden>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Admin Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter Name" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <strong><span id="edit_name_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Email*</strong></span>
                                    </div>
                                    <input type="email" class="form-control" id="edit-email" name="email" placeholder="Enter Email" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <strong><span id="edit_email_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Phone</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-phone" name="phone" placeholder="Enter Phone Number" aria-label="Default" aria-describedby="inputGroup-sizing-default" >
                                </div>
                                <strong><span id="edit_phone_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Password</strong></span>
                                    </div>
                                    <input type="password" class="form-control" id="edit-password" name="password" aria-label="Default" placeholder="Minimum 8 characters" aria-describedby="inputGroup-sizing-default" >
                                </div>
                                <strong><span id="edit_password_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Confirm Password</strong></span>
                                    </div>
                                    <input type="password" class="form-control" id="edit-password_confirmation" name="password_confirmation" aria-label="Default" placeholder="Confirm password" aria-describedby="inputGroup-sizing-default" >
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mr-4" id="inputGroup-sizing-default"><strong>Role<strong></span>
                                    </div>
                                    <label class="fancy-radio mt-1">
                                        <input id="edit-role-admin" name="role_id" value="1" type="radio">
                                        <span><i></i>Admin</span>
                                    </label>

                                    <label class="fancy-radio mt-1">
                                        <input id="edit-role-moderator" name="role_id" value="2" type="radio">
                                        <span><i></i>Moderator</span>
                                    </label>

                                    <label class="fancy-radio mt-1">
                                        <input id="edit-role-editor" name="role_id" value="3" type="radio">
                                        <span><i></i>Editor</span>
                                    </label>


                                    <label class="fancy-radio mt-1">
                                        <input id="edit-role-sub" name="role_id" value="4" type="radio">
                                        <span><i></i>Sub Admin</span>
                                    </label>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Image</strong></span>
                                            </div>
                                            <input id="edit-image" type="file" name="image" class="dropify edit-photo" >
                                        </div> 
                                        <strong><span id="edit_image_error" class="invalid-feedback d-block mb-3" role="alert">
                                        </span> </strong>
                                    </div>
                                    <div class="col-6">
                                        <img hidden width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="" alt="">
                                    </div>
                                </div>                 

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Admin</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--Edit admin modal ends--}}

<!-- upto here -->

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
    <script src="{{asset('/backend/js/admin.js')}}"></script>

@endsection
