@extends('admin.layout.master.master')
@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Top Menu</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>General Setting</span> <i class="fa fa-angle-right"></i>
                <span>Top Menu</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <button class="btn btn-success btn-round" id="addPixelBtn" data-toggle="modal" data-target="#addPixelModal"><i class="fa fa-plus"></i>Add/Update Facebook Pixel</button>
                    <ul class="header-dropdown dropdown">
                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu theme-bg gradient">
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Fb Account Name</th>
                                <th>Pixel Name</th>
                                <th>Pixel ID</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Fb Account Name</th>
                                <th>Pixel Name</th>
                                <th>Pixel ID</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if($pixel)
                                <tr data-id="{{$pixel->id}}">
                                    <td>{{$pixel->facebook_account_name}}</td>
                                    <td>{{$pixel->pixel_name}}</td>
                                    <td>{{$pixel->pixel_id}}</td>
                                </tr>
                            @else
                                <td colspan="4" class="text-center">No data Available</td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Add pixel Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addPixelModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD OR UPDATE FACEBOOK PIXEL</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-pixel-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Facebook Account Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="facebook_account_name" name="facebook_account_name" aria-label="Default" aria-describedby="inputGroup-sizing-default"
                                           placeholder="Facebook Account Name" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong> Pixel Name* </strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="pixel_name" name="pixel_name" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Pixel Name" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong> Pixel ID* </strong></span>
                                    </div>
                                    <input type="number" class="form-control" id="pixel_id" name="pixel_id" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Pixel ID" required>
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Save Pixel</button>
                            </form>
                        </div>
                    </div>
                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Close</button>--}}

{{--                </div>--}}
            </div>
        </div>
    </div>
    {{--Add Method Modal ends--}}

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
    <script src="{{asset('/backend/js/pixel.js')}}"></script>

@endsection
