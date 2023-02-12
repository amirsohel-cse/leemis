@extends('admin.layout.master.master')
@section('main-content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>Sliders</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>Home Page Setting</span> <i class="fa fa-angle-right"></i>
            <span>Sliders</span>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <button class="btn btn-success btn-round" id="addSliderBtn" data-toggle="modal" data-target="#addSliderModal"><i class="fa fa-plus"></i>Add Slider</button>
                <ul class="header-dropdown dropdown">
                    <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                 
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Slider Image</th>
                                {{-- <th>Title</th> --}}
                               <th>Options</th> 
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Slider Image</th>
                                {{-- <th>Title</th> --}}
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($sliders as $row)
                                <tr data-id="{{$row->id}}">
                                    <td style="width:100px height:100px"><img src="\storage\storeSliders\{{$row->image_file}}" alt="image" style="width:100%" height="200px"></td>
                                    {{-- <td>{{$row->title}}</td> --}}
                                    <td>
                                        <button data-id="{{$row->id}}" data-toggle="modal" data-target="#editSliderModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
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


{{--Add Slider Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addSliderModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW SLIDER</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-slider-form" method="post" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Subtitle </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea class="input-field" name="subtitle" required=""  placeholder="Subtitle"></textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Title </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea class="input-field" name="title" required=""  placeholder="Title"></textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong>  Description </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea class="input-field" name="description" required=""  placeholder="Description"></textarea>
                                            
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                Slider Image  
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <input type="file" name="photo" class="dropify photo" required>
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
                                        <input type="text" class="form-control" id="link" name="link" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Link" required>
                                            
                                        </div>
                                    </div>
                                </div>
                                 {{--
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
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong>  Background Image  </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <input type="file" name="b_photo" class="dropify photo" required>
                                        </div>
                                    </div>
                                </div>
                                --}}
                               

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
{{--Add Slider Modal ends--}}


{{--Edit Slider modal starts--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editSliderModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT SLIDER</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-slider-form" method="post" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Subtitle </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea class="input-field" name="edit_subtitle" id="edit_subtitle" required=""  placeholder="Subtitle"></textarea>
                                            
                                        </div>
                                    </div>
                                </div> --}}

                                <input type="text" id="slider-id" name="id" hidden>
                                {{-- <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Title </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea class="input-field" name="edit_title"id="edit_title" required=""  placeholder="Title"></textarea>
                                            
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Description </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea class="input-field" name="edit_description"id="edit_description" required=""  placeholder="Description"></textarea>
                                            
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong> Slider Image  </strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <input type="file" name="photo"class="dropify photo">
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
                                        <input type="text" placeholder="Enter Link" class="form-control" id="edit_link" name="edit_link" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                            
                                        </div>
                                    </div>
                                </div>
                                   {{--
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
                                            <select name="edit_position" id="edit_position" required="" >
                                                <option value="">Select Position</option>
                                                <option value="Left">Left</option>
                                                <option value="Center">Center</option>
                                                <option value="Right">Right</option>
                                            </select>    
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                            <strong>  Background Image </strong> 
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <input type="file" name="b_photo"class="dropify photo">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="100%" height="200px" id="edit_b_photo" style="margin-top: 37px" src="" alt="">
                                    </div>
                                </div> --}}
                               

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update</button>
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
{{--Edit Slider modal ends--}}

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
    <script src="{{asset('/backend/js/slider.js')}}"></script>

@endsection