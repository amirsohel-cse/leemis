@extends('admin.layout.master.master')

@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Category Translations</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Categories</span> <i class="fa fa-angle-right"></i>
                <span>Translations</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h5 class="card-title float-left">All Translations for <b>{{ $category->name }}</b></h5>
                    <button class="btn btn-success btn-round float-right" id="addCategoryBtn" data-toggle="modal"
                        data-target="#addLangCategoryModal"><i class="fa fa-plus"></i> Add Translation</button>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 7%;">Translation ID</th>
                                    <th>Name</th>
                                    <th>Language</th>
                                    <th style="width: 20%;" class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($translations as $row)
                                    <tr data-id="{{ $row->id }}">
                                        <td style="width: 7%;">{{ $row->id }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->lang }}</td>
                                        <td style="width: 20%;" class="text-center">
                                            <button data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-lang="{{ $row->lang }}" data-toggle="modal"
                                                data-target="#editLangCategoryModal"
                                                class="btn btn-primary btn-round mr-1 editDataBtn" style="cursor: pointer"
                                                type="button"><i class="fa fa-edit"></i> Edit</button>

                                            <button data-id="{{ $row->id }}" class="btn btn-danger btn-round deleteBtn"
                                                style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>

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

    {{-- Add category lang Modal --}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addLangCategoryModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD TRANSLATION</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">

                            <form action="" id="add-category-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="" class="col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <div class="text-danger print-error-msg" style="display: none;">
                                            <ul></ul>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="category_id" value="{{ $category->id }}" name="category_id" />
                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $category->name }}" readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Select Language</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="language" id="language">
                                            <option value="">Select language</option>
                                            <option value="EN">English</option>
                                            <option value="cn">Traditional Chinese</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Translated Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="translated_name"
                                            id="translated_name" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <button type="button"
                                            class="btn btn-primary theme-bg gradient add-btn-submit">Add
                                            Translation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal"><b>Close</b></button>
                </div>
            </div>
        </div>
    </div>

    {{-- Update category lang Modal --}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="editLangCategoryModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT TRANSLATION</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">

                            <form action="" id="edit-category-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="" class="col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <div class="text-danger print-edit-error-msg" style="display: none;">
                                            <ul></ul>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="translation_id" name="translation_id" />
                                <input type="hidden" id="edit_category_id" value="{{ $category->id }}" name="category_id" />

                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $category->name }}"
                                            readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Select Language</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="language" id="edit_language">
                                            <option value="">Select language</option>
                                            <option value="EN">English</option>
                                            <option value="cn">Traditional Chinese</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Translated Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="translated_name"
                                            id="edit_translated_name" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <button type="button" class="btn btn-primary theme-bg gradient edit-btn-submit">Update Translation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal"><b>Close</b></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-stylesheet')
    <!--<link rel="stylesheet" href="{{ asset('/backend/assets/css/nice-select.css') }}">-->
@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            $('.editDataBtn').on('click', function() {
                $('#translation_id').val($(this).data('id'));
                $('#edit_language').val($(this).data('lang'));
                $('#edit_translated_name').val($(this).data('name'));
            });
        });
    </script>
    <script>
        $(".add-btn-submit").click(function(e) {
            e.preventDefault();
            var category_id = $("#category_id").val();
            var name = $("#translated_name").val();
            var lang = $("#language").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.addCategoryTranslation') }}",
                data: {
                    category_id: category_id,
                    name: name,
                    lang: lang
                },
                beforeSend: function() {
                    $(".add-btn-submit").addClass('disabled');
                    $(".add-btn-submit").html('<i class="fa fa-spinner fa-spin"></i> Loading');
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.success(data.success);
                        $('#addLangCategoryModal').modal('hide');

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        printErrorMsg(data.error);
                    }
                    $(".add-btn-submit").removeClass('disabled');
                    $(".add-btn-submit").html('Add Translation');
                }
            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });

        }

        $(".edit-btn-submit").click(function(e) {
            e.preventDefault();
            var category_id = $("#edit_category_id").val();
            var translation_id = $("#translation_id").val();
            var name = $("#edit_translated_name").val();
            var lang = $("#edit_language").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.editCategoryTranslation') }}",
                data: {
                    category_id: category_id,
                    translation_id: translation_id,
                    name: name,
                    lang: lang
                },
                beforeSend: function() {
                    $(".edit-btn-submit").addClass('disabled');
                    $(".edit-btn-submit").html('<i class="fa fa-spinner fa-spin"></i> Loading');
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.success(data.success);
                        $('#editLangCategoryModal').modal('hide');

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        printEditErrorMsg(data.error);
                    }
                    $(".edit-btn-submit").removeClass('disabled');
                    $(".edit-btn-submit").html('Update Translation');
                }
            });

        });

        function printEditErrorMsg(msg) {
            $(".print-edit-error-msg").find("ul").html('');
            $(".print-edit-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-edit-error-msg").find("ul").append('<li>' + value + '</li>');
            });

        }

        $(".deleteBtn").click(function(e) {
            var translation_id = $(this).data('id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteCategoryTranslation') }}",
                        data: {
                            translation_id: translation_id
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Deleted',
                                'Your file has been deleted successfully)',
                                'success'
                            )
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })

        });
    </script>
@endsection
