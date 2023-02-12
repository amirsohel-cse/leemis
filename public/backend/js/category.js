$(document).ready(function () {
    // $('.is_featured').on('click',function () {
    //     if ($(this).prop('checked') === true){
    //         $(this).val(1);
    //         $('.feature-category').attr('hidden',false);
    //         $('.image').attr('required',true);
    //         $('.edit-image').attr('required',true);
    //     }else{
    //         $(this).val(0);
    //         $('.feature-category').attr('hidden',true);
    //         $('.image').attr('required',false);
    //         $('.edit-image').attr('required',false);
    //         $('.image').val('');
    //         $('.edit-image').val('');
    //         $('.dropify-clear')[1].click();
    //     }
    // });



    $(document).on('click','#addCategoryBtn',function () {
        //$('.is_featured').prop('checked',false);
      //  $('.feature-category').attr('hidden',true);
        $('.dropify-clear').click();
        $('.catImageError').text('');
        $('.catname').text('');
        $('.slug').text('');
        $('.commision').text('');
        $('.featuredImageError').text('');
        $('.editCatImageError').text('');
        $('.editFeaturedImageError').text('');
    });
});

//Store Category ajax request
$(document).ready(function () {
    $(document).on('submit','#add-category-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/category/store',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#name').val('');
                $('#slug').val('');
                $('#commision').val('');
                $('.image').val('');
                $('.photo').val('');
               // $('.is_featured').prop('checked',false);
                //$('.feature-category').attr('hidden',true);
                $('.closeBtn').click();
                $('.dropify-clear').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Category Successfully Stored');
                appendTableRow(data);
            },
            error: function (error) {
                console.log(error);
                if (typeof(error.responseJSON.errors.name) !== "undefined"){
                    $('.catname').text(error.responseJSON.errors.name[0]);
                }else{
                    $('.catname').text('');
                }

                if (typeof(error.responseJSON.errors.slug) !== "undefined"){
                    $('.slug').text(error.responseJSON.errors.slug[0]);
                }else{
                    $('.slug').text('');
                }

                if (typeof(error.responseJSON.errors.commison) !== "undefined"){
                    $('.commision').text(error.responseJSON.errors.commision[0]);
                }else{
                    $('.commision').text('');
                }
                $('.commision').text(error.responseJSON.errors.commision[0]);

                if (typeof(error.responseJSON.errors.photo) !== "undefined"){
                    $('.catImageError').text(error.responseJSON.errors.photo[0]);
                }else{
                    $('.catImageError').text('');
                }
                if (typeof(error.responseJSON.errors.image) !== "undefined"){
                    $('.featuredImageError').text(error.responseJSON.errors.image[0]);
                }else{
                    $('.featuredImageError').text('');
                }
            }
        })
    });
});

//Delete Category
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
                    url: `/admin/category/${id}/delete`,
                    success: (data) => {
                        $(tableRow).remove();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          )

                    },

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

    });

});




var tableRow = '';
//Show edit form with data ajax request
$(document).ready(function () {
    $(document).on('click','.editBtn',function () {
        const id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $('#category-id').val(id);
        $('.editCatImageError').text('');
       // $('.editFeaturedImageError').text('');

        $.ajax({
            type: 'GET',
            url: `/admin/category/${id}/edit`,
            success: (data) => {
                
                $('#edit-name').val(data.name);
                $('#edit-slug').val(data.slug);
                $('#edit-commision').val(data.commision);
                $('#oldPhoto').attr('src',`../../uploads/category-images/${data.photo}`);
                $('.is_featured').prop('checked',false);
                $('.topbrand').val(data.top_brand)
                $('.dropify-clear').click();
                if (data.is_featured == 1){
                    $('#oldImage').attr('src',`../../uploads/category-images/featured/${data.image}`);
                }
            },
            error: (error) => {
                console.log(error);
            }
        })
    });
});

//Update Category Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-category-form',function (e) {
        e.preventDefault();
        const id = $('#category-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/category/${id}/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-name').val('');
                $('#edit-slug').val('');
                $('#edit-commision').val('');
                $('.edit-image').val('');
                $('.edit-photo').val('');
               // $('.is_featured').prop('checked',false);
               // $('.feature-category').attr('hidden',true);
                $('.closeBtn').click();
                $('.dropify-clear').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Category Successfully Updated!!!');
                console.log(data);
                const a = $(tableRow).find('td');
                $(a[0]).text(data.id);
                $(a[1]).text(data.name);
                $(a[2]).text(data.slug);
                $(a[3]).text(data.commision);



            },
            error: function (error) {
                console.log(error);
                if (typeof(error.responseJSON.errors.name) !== "undefined"){
                    $('.catname').text(error.responseJSON.errors.name[0]);
                }else{
                    $('.catname').text('');
                }

                if (typeof(error.responseJSON.errors.slug) !== "undefined"){
                    $('.slug').text(error.responseJSON.errors.slug[0]);
                }else{
                    $('.slug').text('');
                }

                if (typeof(error.responseJSON.errors.commision) !== "undefined"){
                    $('.commision').text(error.responseJSON.errors.commision[0]);
                }else{
                    $('.commision').text('');
                }
                $('.commision').text(error.responseJSON.errors.commision[0]);
                if (typeof(error.responseJSON.errors.photo) !== "undefined"){
                    $('.editCatImageError').text(error.responseJSON.errors.photo[0]);
                }else{
                    $('.editCatImageError').text('');
                }
               // if (typeof(error.responseJSON.errors.image) !== "undefined"){
                   // $('.editFeaturedImageError').text(error.responseJSON.errors.image[0]);
               // }else{
                   // $('.editFeaturedImageError').text('');
                //}
            }
        })
    });
});

//Status update ajax
$(document).ready(function () {
    $(document).on('change','#selectStatus',function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: `/admin/category/${id}/status/update`,
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

//is feature update
$(document).ready(function () {
    $(document).on('change','#isFeatured',function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: `/admin/category/${id}/feature/update`,
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
        });
    });
});

function appendTableRow(data) {
    $('tbody').append(`
        <tr data-id="${data.id}">
        <td>${data.id}</td>
           <td>${data.name}</td>
                <td>${data.slug}</td>
                <td>${data.commision} % </td>

                <td>
                   <select class="theme-bg" data-id="${data.id}" name="" id="selectStatus">
                      <option value="1" ${data.status == 1 ? 'selected' : ''}>Active</option>
                      <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
                   </select>
                </td>
                <td>
                <select class="theme-bg" name=""  data-id="${data.id}" id="isFeatured">
                    <option value="1" ${data.status == 1 ? 'selected' : ''}>Yes</option>
                    <option value="0" ${data.status == 0 ? 'selected' : ''}>No</option>
                </select>
            </td>
                <td>
                   <button data-id="${data.id}" class="btn btn-primary btn-round mr-1 editBtn" data-toggle="modal" data-target="#editCategoryModal" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                   <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="button"><i class="fa fa-trash"></i></button>
                </td>
        </tr>
    `);
    $('select').niceSelect();
}
