$(document).ready(function () {
    $(document).on('click', '#addSubcategoryBtn', function () {
        $('#categoryId').val('');
        $('#categoryId').niceSelect('destroy');
        $('#name').val('');
        $('#slug').val('');
        $('.catIdError').text('');
        $('.nameError').text('');
        $('.slugError').text('');
    });

    //Storing Sub category
    $(document).on('submit', '#add-subcategory-form', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/subcategory/store',
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                appendTableRow(data.data, data.category);
                $('.catIdError').text('');
                $('.nameError').text('');
                $('.slugError').text('');
                $('.closeBtn').click();

                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Sub Category Successfully Added!!!');
            },
            error: (error) => {
                if (typeof (error.responseJSON.errors.category_id) !== "undefined") {
                    $('.catIdError').text(error.responseJSON.errors.category_id[0]);
                } else {
                    $('.catIdError').text('');
                }

                if (typeof (error.responseJSON.errors.name) !== "undefined") {
                    $('.nameError').text(error.responseJSON.errors.name[0]);
                } else {
                    $('.nameError').text('');
                }

                if (typeof (error.responseJSON.errors.slug) !== "undefined") {
                    $('.slugError').text(error.responseJSON.errors.slug[0]);
                } else {
                    $('.slugError').text('');
                }
            }
        })

    });
});


$(document).on('click', '.editBtn', function (e) {
    id = $(this).data('category');

    $('#editcategoryId').val(id.category_id)
    $('#edit-name').val(id.name);
    $('#edit-slug').val(id.slug);
    $('#indentifier').val(id.id);
    $('.topbrand').val(id.top_brand)

    $('#edit-subcategory-form').attr('action', $(this).data('url'))

});





//Status update ajax
$(document).ready(function () {
    $(document).on('change', '.selectStatus', function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            type: 'GET',
            url: `/admin/subcategory/${id}/statusUpdate`,
            data: { status: status },
            success: (data) => {
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,
                };
                toastr['success'](data);
            },
            error: (error) => {
                console.log(error);
            }
        })
    });
});

//Delete sub category Ajax
$(document).ready(function () {
    $(document).on('click', '.deleteBtn', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let tableRow = $(this).parent().parent();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
                    type: 'DELETE',
                    url: `/admin/subcategory/${id}/delete`,
                    success: (data) => {
                        $(tableRow).remove();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )

                    },
                    error: (error) => {
                        console.log(error);
                    }

                })


            }
            else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your file is safe :)',
                    'error'
                )
            }

        })
        // if (confirm('Are you sure want to delete this SubCategory!!!')){
        //     $.ajax({
        //         type: 'DELETE',
        //         url: `/admin/subcategory/${id}/delete`,
        //         success: (data) => {
        //             $(tableRow).remove();
        //             toastr.options = {
        //                 "timeOut": "2000",
        //                 "closeButton": true,
        //
        //             };
        //             toastr['error'](data);
        //         },
        //         error: (error) => {
        //             console.log(error);
        //         }
        //     })
        // }
    });

});

function appendTableRow(data, category) {
    $('tbody').append(`
        <tr>
            <td>${category}</td>
            <td>${data.name}</td>
            <td>${data.slug}</td>
            <td>
                <select name="" data-id="${data.id}" class="selectStatus">
                    <option value="1" ${data.status == 1 ? 'selected' : ''}>Active</option>
                    <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
                </select>
            </td>
            <td>
                <button data-id="${data.id}" data-toggle="modal" data-target="#editSubCategoryModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    `);
    $(document).ready(function () {
        $('select').niceSelect();
    });
}

