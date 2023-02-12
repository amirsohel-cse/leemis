@extends('admin.layout.master.master')

@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Child Categories</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Manage Categories</span> <i class="fa fa-angle-right"></i>
                <span>Child Categories</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <button class="btn btn-success btn-round" id="addChildcategoryBtn" data-toggle="modal" data-target="#addChildCategoryModal"><i class="fa fa-plus"></i> Add Child Category</button>
                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                       
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sub Category</th>
                                <th>Child Category Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Sub Category</th>
                                <th>Child Category Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse($childcategories as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{isset($row->sub_category->name) ? $row->sub_category->name : ''}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->slug}}</td>
                                    <td>
                                        <select class="theme-bg selectStatus" data-id="{{$row->id}}" >
                                            <option value="1" {{$row->status == 1 ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{$row->status == 0 ? 'selected' : ''}}>Deactive</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button data-id="{{$row->id}}" data-toggle="modal" data-target="#editChildCategoryModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                                        <button data-id="{{$row->id}}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
                                    </td>

                                    @empty
                                        <td colspan="5" class="text-center">No data Available</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{--Add subcategory Modal starts--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addChildCategoryModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW CHILD CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-childcategory-form" method="post">
                                @csrf
                                <span style="color: red" class="catIdError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select SubCategory*</strong></span>
                                    </div>
                                    <select class="form-control" name="sub_category_id" id="categoryId">
                                        <option value="" data-display="Select"><strong>Select SubCategory</strong></option>
                                        @forelse($subcategories as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @empty
                                            <option value=""><strong>No SubCategory Added</strong></option>
                                        @endforelse
                                    </select>
                                </div>

                                <span style="color: red" class="nameError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Child Category Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Child Category Name">
                                </div>

                                <span style="color: red" class="slugError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="slug" name="slug" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Slug">
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Save ChildCategory</button>
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
    {{--Add subCategory Modal ends--}}

    {{--Edit Sub Category Modal Starts--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editChildCategoryModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT CHILD CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-childcategory-form" method="post">
                                @csrf
                                <span style="color: red" class="catIdError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select Sub Category*</strong></span>
                                    </div>
                                    <select class="form-control" name="sub_category_id" id="editcategoryId">
                                        <option value="" data-display="Select">Select SubCategory</option>
                                        @forelse($subcategories as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @empty
                                            <option value="">No Sub Categories Added</option>
                                        @endforelse
                                    </select>
                                </div>

                                <span style="color: red" class="nameError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Child Category Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name" aria-label="Default" placeholder="Enter Child Category Name" aria-describedby="inputGroup-sizing-default">
                                </div>

                                <span style="color: red" class="slugError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-slug" name="slug" placeholder="Enter Slug" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update ChildCategory</button>
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
    {{--Edit Sub Category Modal Ends--}}



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
    <script src="{{asset('/backend/js/child-category.js')}}"></script>

@endsection
