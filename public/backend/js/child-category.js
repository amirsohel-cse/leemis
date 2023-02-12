$(document).ready(function () {
    $(document).on('click','#addChildcategoryBtn',function () {
        $('#categoryId').val('');
        $('#categoryId').niceSelect('destroy');
        $('#name').val('');
        $('#slug').val('');
        $('.catIdError').text('');
        $('.nameError').text('');
        $('.slugError').text('');
    });

    $(document).on('submit','#add-childcategory-form',function (e) {
        e.preventDefault();
        const subCategoryId = $('#categoryId').val();
        const name = $('#name').val();
        const slug = $('#slug').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/childcategory/store',
            data: {
                sub_category_id: subCategoryId,
                name: name,
                slug: slug
            },
            success: (data) => {
                appendTableRow(data.data,data.subcategory);
                $('.catIdError').text('');
                $('.nameError').text('');
                $('.slugError').text('');
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Child Category Successfully Stored!!!');
            },
            error: (error) => {
                if (typeof(error.responseJSON.errors.sub_category_id) !== "undefined"){
                    $('.catIdError').text(error.responseJSON.errors.sub_category_id[0]);
                }else{
                    $('.catIdError').text('');
                }

                if (typeof(error.responseJSON.errors.name) !== "undefined"){
                    $('.nameError').text(error.responseJSON.errors.name[0]);
                }else{
                    $('.nameError').text('');
                }

                if (typeof(error.responseJSON.errors.slug) !== "undefined"){
                    $('.slugError').text(error.responseJSON.errors.slug[0]);
                }else{
                    $('.slugError').text('');
                }
            }
        })

    });
});
var id = '';
var tableRow = '';

//Edit button clicked
$(document).ready(function () {
    $(document).on('click','.editBtn',function (e) {
        id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $.ajax({
            type: 'GET',
            url: `/admin/childcategory/${id}/edit`,
            success: (data) => {
                let op = $('#editcategoryId option[value='+data.sub_category_id+']');
                $(op).attr('selected',true);
                let a = $('#editcategoryId').next().find('.current');
                $(a).text($(op).text());
                $('#edit-name').val(data.name);
                $('#edit-slug').val(data.slug);
            },
            error: (error) => {
                console.log(error)
            }
        })
    });
});

//Submit edit form
$(document).ready(function () {
    $(document).on('submit','#edit-childcategory-form',function (e) {
        e.preventDefault();
        const categoryId = $('#editcategoryId').val();
        const name = $('#edit-name').val();
        const slug = $('#edit-slug').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'PATCH',
            url: `/admin/childcategory/${id}/update`,
            data: {
                sub_category_id: categoryId,
                name: name,
                slug: slug
            },
            success: (data) => {
                $('.catIdError').text('');
                $('.nameError').text('');
                $('.slugError').text('');
                $('.closeBtn').click();
                let td = $(tableRow).find('td');
                $(td[0]).text(data.id);
                $(td[1]).text(data.subcategory);
                $(td[2]).text(data.childcategory.name);
                $(td[3]).text(data.childcategory.slug);
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Child Category Successfully Updated!!!');

            },
            error: (error) => {
                console.log(error);
                if (typeof(error.responseJSON.errors.category_id) !== "undefined"){
                    $('.catIdError').text(error.responseJSON.errors.category_id[0]);
                }else{
                    $('.catIdError').text('');
                }
                
                if (typeof(error.responseJSON.errors.name) !== "undefined"){
                    $('.nameError').text(error.responseJSON.errors.name[0]);
                }else{
                    $('.nameError').text('');
                }
                
                if (typeof(error.responseJSON.errors.slug) !== "undefined"){
                    $('.slugError').text(error.responseJSON.errors.slug[0]);
                }else{
                    $('.slugError').text('');
                }
            }

        })
    })
});

//Status update ajax
$(document).ready(function () {
    $(document).on('change','.selectStatus',function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: `/admin/childcategory/${id}/statusUpdate`,
            data: {status: status},
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
                    url: `/admin/childcategory/${id}/delete`,
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
        //         url: `/admin/childcategory/${id}/delete`,
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

function appendTableRow(data,subCategory) {
    $('tbody').append(`
        <tr>
        <td>${data.id}</td>
            <td>${subCategory}</td>
            <td>${data.name}</td>
            <td>${data.slug}</td>
            <td>
                <select class="theme-bg" name="" data-id="${data.id}" class="selectStatus">
                    <option value="1" ${data.status == 1 ? 'selected' : ''}>Active</option>
                    <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
                </select>
            </td>
            <td>
                <button data-id="${data.id}" data-toggle="modal" data-target="#editChildCategoryModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    `);
    $(document).ready(function () {
        $('select').niceSelect();
    });
}

