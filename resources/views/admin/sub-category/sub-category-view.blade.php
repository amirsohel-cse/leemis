@extends('admin.layout.master.master')

@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Sub Categories</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Manage Categories</span> <i class="fa fa-angle-right"></i>
                <span>Sub Categories</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <button class="btn btn-success btn-round" id="addSubcategoryBtn" data-toggle="modal"
                        data-target="#addSubCategoryModal"><i class="fa fa-plus"></i> Add Sub Category</button>
                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>

                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Sub Category Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Category</th>
                                    <th>Sub Category Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse($subcategories as $row)
                                    <tr>
                                        <td>{{ isset($row->category->name) ? $row->category->name : '' }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td>
                                            <select class="theme-bg selectStatus" data-id="{{ $row->id }}">
                                                <option value="1" {{ $row->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ $row->status == 0 ? 'selected' : '' }}>Deactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button data-id="{{ $row->id }}" data-toggle="modal"
                                                data-target="#editSubCategoryModal" data-category="{{$row}}" data-url="{{route('subcategory-update', $row->id)}}"
                                                class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                                type="button"><i class="fa fa-edit"></i> Edit</button>
                                            <a class="btn btn-primary mr-1"
                                                href="{{ route('admin.subCategoryTranslations',['id'=>$row->id]) }}"
                                                data-toggle="tooltip" title="Translations">
                                                <i class="fa fa-language"></i>
                                            </a>
                                            <button data-id="{{ $row->id }}" class="btn btn-danger btn-round deleteBtn"
                                                style="cursor: pointer" type="submit"><i
                                                    class="fa fa-trash"></i></button>
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


    {{-- Add subcategory Modal starts --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addSubCategoryModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW SUB CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-subcategory-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <span style="color: red" class="catIdError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select
                                                Category*</strong></span>
                                    </div>
                                    <select class="form-control" name="category_id" id="categoryId">
                                        <option value="" data-display="Select"><strong>Select Category</strong></option>
                                        @forelse($categories as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @empty
                                            <option value=""><strong>No Categories Added</strong></option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Sub Category
                                                Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Sub Category name">
                                </div>
                                <span style="color: red" class="nameError"></span>

                                <span style="color: red" class="slugError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="slug" name="slug" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Slug">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Photo*</strong></span>
                                    </div>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                </div>

                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Top
                                                Brand*</strong></span>
                                    </div>
                                    <select name="top_brand" id="" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient"><strong>Save
                                        SubCategory</strong></button>
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
    {{-- Add subCategory Modal ends --}}

    {{-- Edit Sub Category Modal Starts --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editSubCategoryModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT SUB CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-subcategory-form" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" id="indentifier">
                                <span style="color: red" class="catIdError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select
                                                Category*</strong></span>
                                    </div>
                                    <select class="form-control" name="category_id" id="editcategoryId">
                                        <option value=""><strong>Select Category</strong></option>
                                        @forelse($categories as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @empty
                                            <option value=""><strong>No Categories Added</strong></option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Sub Category
                                                Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name"
                                        placeholder="Enter Sub Category Name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default">

                                </div>
                                <span style="color: red" class="nameError"></span>


                                <span style="color: red" class="slugError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-slug" name="slug"
                                        placeholder="Enter Slug" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Photo*</strong></span>
                                    </div>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                </div>

                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Top
                                                Brand*</strong></span>
                                    </div>
                                    <select name="top_brand" id="" class="form-control topbrand">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update SubCategory</button>
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
@endsection

@section('page-scripts')
    <script src="{{ asset('/backend/js/sub-category.js') }}"></script>
@endsection
