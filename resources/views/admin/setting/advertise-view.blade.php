@extends('admin.layout.master.master')
@section('main-content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>Advertisements</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>Home Page Setting</span> <i class="fa fa-angle-right"></i>
            <span>Advertisements</span>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <button class="btn btn-success btn-round" id="addAdvertiseBtn" data-toggle="modal" data-target="#addAdvertiseModal"><i class="fa fa-plus"></i>Add Advertisement</button>
                <ul class="header-dropdown dropdown">
                    <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>

                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Featured Image</th>
                                <th>Link</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Featured Image</th>
                                <th>Link</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($advertise as $row)
                                <tr data-id="{{$row->id}}">
                                    <td style="width:100px height:100px"><img src="\storage\advertise\{{$row->image_file}}" alt="image" style="width:100%" height="200px"></td>
                                    <td>{{$row->link}}</td>
                                    <td>
                                        <button data-id="{{$row->id}}" data-toggle="modal" data-target="#editAdvertiseModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
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


{{--Add Advertise Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addAdvertiseModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW ADVERTISEMENT</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-advertise-form" method="post" enctype="multipart/form-data">
                                @csrf
<!--                                <div class="row justify-content-center">-->
<!--{{--                                    <div class="col-lg-3">--}}-->
<!--{{--                                        <div class="left-area">--}}-->
<!--{{--                                            <h4 class="heading">--}}-->
<!--{{--                                            <strong> Subtitle</strong> --}}-->
<!--{{--                                            </h4>--}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                    <div class="col-lg-6">--}}-->
<!--{{--                                        <div class="tawk-area">--}}-->
<!--{{--                                            <textarea class="input-field" name="subtitle" required=""  placeholder="Enter Subtitle"></textarea>--}}-->
<!--{{--                                            --}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--                                </div>-->
<!--{{--                                <div class="row justify-content-center">--}}-->
<!--{{--                                    <div class="col-lg-3">--}}-->
<!--{{--                                        <div class="left-area">--}}-->
<!--{{--                                            <h4 class="heading">--}}-->
<!--{{--                                            <strong> Title </strong>--}}-->
<!--{{--                                            </h4>--}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                    <div class="col-lg-6">--}}-->
<!--{{--                                        <div class="tawk-area">--}}-->
<!--{{--                                            <textarea class="input-field" name="title" required=""  placeholder="Enter Title"></textarea>--}}-->
<!--{{--                                            --}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                </div>--}}-->
<!--{{--                                <div class="row justify-content-center">--}}-->
<!--{{--                                    <div class="col-lg-3">--}}-->
<!--{{--                                        <div class="left-area">--}}-->
<!--{{--                                            <h4 class="heading">--}}-->
<!--{{--                                            <strong> Description </strong>--}}-->
<!--{{--                                            </h4>--}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                    <div class="col-lg-6">--}}-->
<!--{{--                                        <div class="tawk-area">--}}-->
<!--{{--                                            <textarea class="input-field" name="description" required=""  placeholder="Enter Description"></textarea>--}}-->
<!--{{--                                            --}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                </div>--}}-->
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Featured Image </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <input type="file" name="photo" class="dropify photo" data-allowed-file-extensions="png jpg jpeg" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                <br>
                                                <strong> Link </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                        <br>
                                        <input type="text" class="form-control" id="link" name="link" aria-label="Default" aria-describedby="inputGroup-sizing-default"  placeholder ="Enter Link" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <br>
                                            <strong> Text Postion </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <br>
                                            <select name="position" required="">
                                                <option value="">Select Position</option>
                                                <option value="Left">Left</option>
                                                <option value="Center">Center</option>
                                                <option value="Right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>




                                <button type="submit" class="btn btn-primary theme-bg gradient">Save</button>
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
{{--Add Advertise Modal ends--}}


{{--Edit Advertise modal starts--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editAdvertiseModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong> EDIT ADVERTISE </strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-advertise-form" method="post" enctype="multipart/form-data">
                                @csrf
<!--{{--                                <div class="row justify-content-center">--}}-->
<!--{{--                                    <div class="col-lg-3">--}}-->
<!--{{--                                        <div class="left-area">--}}-->
<!--{{--                                            <h4 class="heading">--}}-->
<!--{{--                                            <strong> Subtitle </strong>--}}-->
<!--{{--                                            </h4>--}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                    <div class="col-lg-6">--}}-->
<!--{{--                                        <div class="tawk-area">--}}-->
<!--{{--                                            <textarea class="input-field" name="edit_subtitle" id="edit_subtitle" required=""  placeholder="Enter Subtitle"></textarea>--}}-->
<!--{{--                                            --}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                </div>--}}-->

<!--{{--                                --}}{{--advertise id input file--}}-->
                                <input type="text" id="advertise-id" name="id" hidden>
<!--{{--                                <div class="row justify-content-center">--}}-->
<!--{{--                                    <div class="col-lg-3">--}}-->
<!--{{--                                        <div class="left-area">--}}-->
<!--{{--                                            <h4 class="heading">--}}-->
<!--{{--                                            <strong>Title </strong>--}}-->
<!--{{--                                            </h4>--}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                    <div class="col-lg-6">--}}-->
<!--{{--                                        <div class="tawk-area">--}}-->
<!--{{--                                            <textarea class="input-field" name="edit_title"id="edit_title" required=""  placeholder="Enter Title"></textarea>--}}-->
<!--{{--                                            --}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                </div>--}}-->
<!--{{--                                <div class="row justify-content-center">--}}-->
<!--{{--                                    <div class="col-lg-3">--}}-->
<!--{{--                                        <div class="left-area">--}}-->
<!--{{--                                            <h4 class="heading">--}}-->
<!--{{--                                            <strong>Description </strong>--}}-->
<!--{{--                                            </h4>--}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                    <div class="col-lg-6">--}}-->
<!--{{--                                        <div class="tawk-area">--}}-->
<!--{{--                                            <textarea class="input-field" name="edit_description"id="edit_description" required=""  placeholder="Enter Description"></textarea>--}}-->
<!--{{--                                            --}}-->
<!--{{--                                        </div>--}}-->
<!--{{--                                    </div>--}}-->
<!--{{--                                </div>--}}-->
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Featured Image</strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <input type="file" name="photo" class="dropify photo" data-allowed-file-extensions="png jpg jpeg">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="100%" height="200px" id="edit_photo" style="margin-top: 37px" src="" alt="">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                <br>
                                                <strong>  Link </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                        <br>
                                        <input type="text" class="form-control" placeholder="Enter Link" id="edit_link" name="edit_link" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <br>
                                            <strong>Text Postion  </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <br>
                                            <select name="edit_position" id="edit_position" required="" >
                                                <option value="">Select Position</option>
                                                <option value="Left">Left</option>
                                                <option value="Center">Center</option>
                                                <option value="Right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Advertise</button>
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
{{--Edit Advertise modal ends--}}

@endsection
@section('page-stylesheet')
    <!--<link rel="stylesheet" href="{{asset('/backend/assets/css/nice-select.css')}}">-->

@endsection
@section('page-scripts')
    <!--<script src="{{asset('/backend/assets/js/jquery.nice-select.js')}}"></script>-->
    <script !src="">
        // $(document).ready(function () {
        //     $('select').niceSelect();
        // });
    </script>
    <script src="{{asset('/backend/js/advertise.js')}}"></script>

@endsection
