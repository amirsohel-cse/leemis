$(document).ready(function () {
    $('.is_featured').on('click',function () {
        if ($(this).prop('checked') === true){
            $(this).val(1);
            $('.feature-brand').attr('hidden',false);
            $('.image').attr('required',true);
            $('.edit-image').attr('required',true);
        }else{
            $(this).val(0);
            $('.feature-brand').attr('hidden',true);
            $('.image').attr('required',false);
            $('.edit-image').attr('required',false);
            $('.image').val('');
            $('.edit-image').val('');
            $('.dropify-clear')[1].click();
        }
    });

    $(document).on('click','#addbrandBtn',function () {
        $('.is_featured').prop('checked',false);
        $('.feature-brand').attr('hidden',true);
        $('.dropify-clear').click();
        $('.bname').text('');
        $('.slug').text('');
        $('.photo').text('');
    });
});

//Store brand ajax request
$(document).ready(function () {
    $(document).on('submit','#add-brand-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/brand/store',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#name').val('');
                $('#slug').val('');
                $('.image').val('');
                $('.photo').val('');
                $('.is_featured').prop('checked',false);
                $('.feature-brand').attr('hidden',true);
                $('.closeBtn').click();
                $('.dropify-clear').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('brand Successfully Stored');
                appendTableRow(data);
            },
            error: function (error) {
                console.log(error);
                if (typeof(error.responseJSON.errors.name) !== "undefined"){
                    $('.bname').text(error.responseJSON.errors.name[0]);
                }else{
                    $('.bname').text('');
                }

                if (typeof(error.responseJSON.errors.slug) !== "undefined"){
                    $('.slug').text(error.responseJSON.errors.slug[0]);
                }else{
                    $('.slug').text('');
                }



                if (typeof(error.responseJSON.errors.photo) !== "undefined"){
                    $('.photo').text(error.responseJSON.errors.photo[0]);
                }else{
                    $('.photo').text('');
                }
            }
        })
    });
});


//delete

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
          })
          
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
                    url: `/admin/brand/${id}/delete`,
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
$(document).ready(function () {
    $(document).on('click','.editBtn',function () {
        $('.editname').text('');
        $('.editslug').text('');
        $('.editphoto').text('');

        const id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $('#brand-id').val(id);

        $.ajax({
            type: 'GET',
            url: `/admin/brand/${id}/edit`,
            success: (data) => {
                $('#edit-name').val(data.name);
                $('#edit-slug').val(data.slug);
                $('#oldPhoto').attr('src',`../../uploads/brand-images/${data.photo}`);
                $('.is_featured').prop('checked',false);
                $('.feature-brand').attr('hidden',true);
                $('.dropify-clear').click();
                if (data.is_featured == 1){
                    $('#oldImage').attr('src',`../../uploads/brand-images/featured/${data.image}`);
                }
            },
            error: (error) => {
                console.log(error);
            }
        })
    });
});

//Update brand Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-brand-form',function (e) {
        e.preventDefault();
        const id = $('#brand-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/brand/${id}/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-name').val('');
                $('#edit-slug').val('');
                $('.edit-image').val('');
                $('.edit-photo').val('');
                $('.is_featured').prop('checked',false);
                $('.feature-brand').attr('hidden',true);
                $('.closeBtn').click();
                $('.dropify-clear').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Brand Successfully Updated!!!');
                console.log(data);
                const a = $(tableRow).find('td');
                $(a[0]).text(data.name);
                $(a[1]).text(data.slug);


            },
            error: function (error) {
                console.log(error);
                 if (typeof(error.responseJSON.errors.name) !== "undefined"){
                    $('.editname').text(error.responseJSON.errors.name[0]);
                }else{
                    $('.editname').text('');
                }

                if (typeof(error.responseJSON.errors.slug) !== "undefined"){
                    $('.editslug').text(error.responseJSON.errors.slug[0]);
                }else{
                    $('.editslug').text('');
                }



                if (typeof(error.responseJSON.errors.photo) !== "undefined"){
                    $('.editphoto').text(error.responseJSON.errors.photo[0]);
                }else{
                    $('.editphoto').text('');
                }
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
            url: `/admin/brand/${id}/status/update`,
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


//is featured update
$(function (){
    $(document).on('change','#isFeatured',function (){
        let id = $(this).attr('data-id');
        let status = $(this).val();
        $.ajax({
            type: 'GET',
            url: `/admin/brand/${id}/featured/update`,
            data: {status : status},
            success: (data) => {
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success'](data);
            }
        })
    })
})

function appendTableRow(data) {
    $('tbody').append(`
        <tr data-id="${data.id}">
           <td>${data.name}</td>
            <td>${data.slug}</td>
                <td>
                   <select class="theme-bg" data-id="${data.id}" name="" id="selectStatus">
                      <option value="1" ${data.status == 1 ? 'selected' : ''}>Active</option>
                      <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
                   </select>
                </td>
                  <td>
                <select class="theme-bg"  data-id="${data.id}" id="isFeatured">
                    <option class="text-dark" value="1" ${data.is_featured == 1 ? 'selected' : ''}>Yes</option>
                    <option class="text-dark" value="0" ${data.is_featured == 0 ? 'selected' : ''}>No</option>
                </select>
            </td>
                <td>
                   <button data-id="${data.id}" class="btn btn-primary btn-round mr-1 editBtn" data-toggle="modal" data-target="#editbrandModal" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                   <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="button"><i class="fa fa-trash"></i></button>
                </td>
        </tr>
    `);
    $('select').niceSelect();
}
