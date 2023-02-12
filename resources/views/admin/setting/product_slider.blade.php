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
                                
                               <th>Options</th> 
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Slider Image</th>
                               
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($sliders as $row)
                                <tr data-id="{{$row->id}}">
                                    <td style="width:100px height:100px"><img src="\storage\storeSliders\{{$row->photo}}" alt="image" style="width:100%" height="200px"></td>
                                    {{-- <td>{{$row->title}}</td> --}}
                                    <td>
                                        <button data-slider="{{$row}}" data-image="\storage\storeSliders\{{$row->photo}}" data-url="{{route('product.slider.update', $row->id)}}" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                                        <a href="{{route('product.slider.delete', $row->id)}}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></a>
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
                                
                                
                                   <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <p class="heading">
                                                Select  category
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                              <select class="form-control" name="subcategorysliderstore" id="categoryId">
                                        <option value="" data-display="Select"><strong>Select Category</strong></option>
                                        
                                        @forelse($category as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @empty
                                            <option value=""><strong>No Category Added</strong></option>
                                        @endforelse
                                    </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <p class="heading">
                                                Slider Image  ( 1440 px by 300 px )
                                            </p>
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
                               
                                <input type="text" id="slider-id" name="id" hidden>
                                
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <p class="heading">
                                                Select  category
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                              <select class="form-control" name="subcategorysliderstore" id="categoryId_edit">
                                        <option value="" data-display="Select"><strong>Select SubCategory</strong></option>
                                        
                                        @forelse($category as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @empty
                                            <option value=""><strong>No SubCategory Added</strong></option>
                                        @endforelse
                                    </select>
                                        </div>
                                    </div>
                                </div>

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



@section('page-scripts')
    <script>
        $(function(){
            $('.editBtn').on('click', function(){
                const modal = $('#editSliderModal');

                modal.find('form').attr('action', $(this).data('url'))

                modal.find('#edit_link').val($(this).data('slider').link)
                modal.find('#edit_photo').attr('src', $(this).data('image'))
                 modal.find('#categoryId_edit').val($(this).data('slider').category_id)

                
                modal.modal('show')
            })


            
        })
    </script>
@endsection