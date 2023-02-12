$(document).ready(function () {
    $(document).on('click', '#addTopMenuBtn', function () {
        $('#topmenu-id').val('');
        $('#name').val('');
        $('#url').val('');
    });

    //Storing Sub category
    $(document).on('submit', '#add-topmenu-form', function (e) {
        e.preventDefault();
        const name = $('#name').val();
        const url = $('#url').val();
        const category = $('#category_id').val();
        const brand = $('#brand_id').val();
        const images = $('.upload__inputfile').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/setting/topmenu/store',
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: (data) => {
                appendTableRow(data);
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,
                };
                toastr['success']('T Successfully Added!!!');
            },
            error: (error) => {
                console.log(error);
            }
        })

    });
});
var id = '';
var tableRow = '';
$(document).ready(function () {
    $(document).on('click', '.editBtn', function (e) {
        
        const modal = $('#editTopMenuModal');
        
        let category= [];
        let menuBrands= [];
        let html = '';
        
        $('#topmenu-id').val($(this).data('row').id);
        
        modal.find('input[name=name]').val($(this).data('row').name)
        modal.find('input[name=url]').val($(this).data('row').url)
        
        $.each($(this).data('row').photo_path , function(key, value){
            html += `
                <div style="background-image: url(${value}); padding-bottom:50% !important; width:50%" data-number="0" data-file="en-top-home-2.jpg" class="img-bg"><div class="upload__img-close"></div></div>
            `
        })
        
        $('.upload__img-wrap').html(html)
        
         $.each($(this).data('row').menu_categories, function (key, value) {
                 
               category.push(value.category_id)
                    
        }); 
        
        
        $.each($(this).data('row').menu_brands, function (key, value) {
                 
               menuBrands.push(value.brand_id)
                    
        });
        
        
      
        $('#edit_category_id').val(category).selectric();
        
        
        $('#edit_brand_id').val(menuBrands).selectric();
        

        
        
        
        modal.modal('show')
        
        
    });
});

$(document).ready(function () {
    $(document).on('submit', '#edit-topmenu-form', function (e) {
        e.preventDefault();
        const id = $('#topmenu-id').val();
        const name = $('#edit-name').val();
        const url = $('#edit-url').val();
        const category =$('#edit_category_id').val()
        const brand = $('#edit_brand_id').val()
        const images = $('.upload__inputfile').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/setting/${id}/topmenu/update`,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: (data) => {
                let td = $(tableRow).find('td');
                $(td[0]).text(data.name);
                $(td[1]).text(data.url);
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,
                };
                toastr['success']('Top Menu Successfully Updated!!!');
            },
            error: (error) => {
                console.log(error)
            }

        })
    })
});

//Status update ajax
$(document).ready(function () {
    $(document).on('change', '.selectStatus', function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: `/admin/setting/${id}/topmenu/statusUpdate`,
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
                    url: `/admin/setting/${id}/topmenu/delete`,
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

function appendTableRow(data) {
    $('tbody').append(`
        <tr>
            <td>${data.name}</td>
            <td>${data.url}</td>
            <td>
                <select name="" data-id="${data.id}" class="selectStatus">
                    <option value="1" selected>Active</option>
                    <option value="0" >Deactive</option>
                </select>
            </td>
            <td>
                <button data-id="${data.id}" data-toggle="modal" data-target="#editTopMenuModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    `);
    $(document).ready(function () {
        $('select').niceSelect();
    });
}

