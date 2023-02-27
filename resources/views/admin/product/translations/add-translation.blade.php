@extends('admin.layout.master.master')

@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Product Translations</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Products</span> <i class="fa fa-angle-right"></i>
                <span>Translations</span> <i class="fa fa-angle-right"></i>
                <span>Add Translation</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h5 class="card-title float-left">Ad Translations for <b>{{ $product->name }}</b></h5>
                    <a href="{{ route('admin.productTranslations', ['id' => $product->id]) }}"
                        class="btn btn-success btn-round float-right" id="addProductBtn"><i class="fa fa-plus"></i> All
                        Translations</a>
                </div>
                <div class="body">
                    <div class="form-group row mt-3">
                        <div class="col-md-12 text-start">
                            <div class="text-danger print-error-msg text-start" style="display: none;">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                    <form action="" id="add-product-translation-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" value="{{ $product->name }}" readonly />
                                <input type="hidden" class="form-control" value="{{ $product->id }}" id="product_id" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="">Select Language</label>
                                <select class="form-control" name="language" id="language" required>
                                    <option value="">Select language</option>
                                    <option value="EN">English</option>
                                    <option value="cn">Traditional Chinese</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="">Translated Name</label>
                                <input type="text" class="form-control" name="translated_name" placeholder="Enter name"
                                    id="translated_name" />
                            </div>

                            <div class="col-md-12">
                                <label for="" class="">Translated Description</label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Enter Description" id="summernote_editor" name="details" rows="7"></textarea>

                                    <textarea style="display: none;" id="description"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary spec" type="button"> <i class="fa fa-plus"></i> Add
                                    New Specification</button>
                            </div>

                            <div class="col-md-12 mt-3 appear">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label>Specification Title</label>
                                        <input name="specification" id="spec_title" class="form-control spec_title" placeholder="Enter title" required>
                                    </div>

                                    <div class="col-md-8">
                                        <label>Specification Details</label>
                                        <input name="specification" id="spec_details" class="form-control spec_details" placeholder="Enter details" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 text-center">
                            <button type="button" class="btn btn-primary theme-bg gradient add-btn-submit w-50 add-btn-submit">Add Translation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
@endsection
@section('page-stylesheet')
    <!--<link rel="stylesheet" href="{{ asset('/backend/assets/css/nice-select.css') }}">-->
@endsection
@section('page-scripts')
    <script>
        $(document).ready(function(){
            $('#summernote_editor').summernote({
                height: 170,
                callbacks: {
                    onChange: function(contents, $editable) {
                        $('#description').val(contents);
                    }
                }
            });
        });
    </script>
    <script>
        let incrementer = 1;
        $('.spec').on('click', function(e) {
            e.preventDefault();
            let html = `
                <div class="row removeEl">
                    <div class="col-md-4">
                        <label>Specification Title</label>
                        <input name="specification" id="spec_title" class="form-control spec_title" placeholder="Enter title" required>
                    </div>
                    
                    <div class="col-md-7">
                        <label>Specification Details</label>
                        <input name="specification" id="spec_details" class="form-control spec_details" placeholder="Enter details" required>
                    </div>
                        <div class="col-md-1">
                        <label class="w-100"></label>
                        <button type="button" class="btn btn-danger remove"> <i class="fa fa-trash"></i> </button>
                    </div>
                </div>
            `;

            $('.appear').append(html);
            incrementer++;
        });
        $(document).on('click', '.remove', function() {
            $(this).closest('.removeEl').remove();
        });
    </script>
    <script>
        $(".add-btn-submit").click(function(e) {
            e.preventDefault();
            var product_id = $("#product_id").val();
            var name = $("#translated_name").val();
            var lang = $("#language").val();
            var description = $("#description").val();

            var specifications = [];
            var inputs_title = $(".spec_title");
            var inputs_details = $(".spec_details");
            for(var i = 0; i < inputs_title.length; i++){
                if ($(inputs_title[i]).val()) {
                    specifications.push({ title: $(inputs_title[i]).val(), details: $(inputs_details[i]).val() });
                }
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.addProductTranslation') }}",
                data: {
                    product_id: product_id,
                    name: name,
                    lang: lang,
                    description: description,
                    specifications: specifications
                },
                beforeSend: function() {
                    $(".add-btn-submit").addClass('disabled');
                    $(".add-btn-submit").html('<i class="fa fa-spinner fa-spin"></i> Loading');
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.success(data.success);
                        $('#addLangProductModal').modal('hide');

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


        // $(".deleteBtn").click(function(e) {
        //     var translation_id = $(this).data('id');

        //     const swalWithBootstrapButtons = Swal.mixin({
        //         customClass: {
        //             confirmButton: 'btn btn-success ml-2',
        //             cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     });

        //     swalWithBootstrapButtons.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'No, cancel!',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 type: 'POST',
        //                 url: "{{ route('admin.deleteCategoryTranslation') }}",
        //                 data: {
        //                     translation_id: translation_id
        //                 },
        //                 success: function(data) {
        //                     swalWithBootstrapButtons.fire(
        //                         'Deleted',
        //                         'Your file has been deleted successfully)',
        //                         'success'
        //                     )
        //                     setTimeout(() => {
        //                         location.reload();
        //                     }, 1000);
        //                 }
        //             });
        //         } else if (
        //             result.dismiss === Swal.DismissReason.cancel
        //         ) {
        //             swalWithBootstrapButtons.fire(
        //                 'Cancelled',
        //                 'Your file is safe :)',
        //                 'error'
        //             )
        //         }
        //     })

        // });
    </script>
@endsection
