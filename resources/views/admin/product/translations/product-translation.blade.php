@extends('admin.layout.master.master')

@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Product Translations</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Products</span> <i class="fa fa-angle-right"></i>
                <span>Translations</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h5 class="card-title float-left">All Translations for <b>{{ $product->name }}</b></h5>
                    <a href="{{ route('admin.addProductTranslationView', ['id'=>$product->id]) }}" class="btn btn-success btn-round float-right" id="addProductBtn"><i class="fa fa-plus"></i> Add Translation</a>
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
                                            <a href="{{ route('admin.editProductTranslationView', ['product_id'=>$product->id, 'translation_id'=>$row->id]) }}" class="btn btn-primary btn-round mr-1 editDataBtn" style="cursor: pointer"><i class="fa fa-edit"></i> Edit</a>

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
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addLangProductModal" role="dialog"
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

                                <input type="hidden" id="product_id" value="{{ $product->id }}" name="product_id" />
                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $product->name }}" readonly />
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
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="editLangProductModal" role="dialog"
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
                                <input type="hidden" id="edit_category_id" value="{{ $product->id }}" name="category_id" />

                                <div class="form-group row">
                                    <label for="" class="col-sm-3">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $product->name }}"
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
                        url: "{{ route('admin.deleteProductTranslation') }}",
                        data: {
                            translation_id: translation_id
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Deleted',
                                'Translation has been deleted successfully)',
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
                        'Translation is safe :)',
                        'error'
                    )
                }
            })

        });
    </script>
@endsection
