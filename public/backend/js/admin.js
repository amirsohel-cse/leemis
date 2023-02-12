
// remove validation errors when close the moadal
$(function(){
    $("#addAdminModal").on('hide.bs.modal', function(){
        // remove errors
        $('#name').removeClass('is-invalid');
        $('#name_error').text(null);
        $('#name_error').hide();
        $('#email').removeClass('is-invalid');
        $('#email_error').text(null);
        $('#email_error').hide();
        $('#phone').removeClass('is-invalid');
        $('#phone_error').text(null);
        $('#phone_error').hide();
        $('#password').removeClass('is-invalid');
        $('#password_error').text(null);
        $('#password_error').hide();
        $('#image').removeClass('is-invalid');
        $('#image_error').text(null);
        $('#image_error').hide();
    });
    $("#editAdminModal").on('hide.bs.modal', function(){
        // remove errors
        $('#edit-name').removeClass('is-invalid');
        $('#edit_name_error').text(null);
        $('#edit_name_error').hide();

        $('#edit-email').removeClass('is-invalid');
        $('#edit_email_error').text(null);
        $('#edit_email_error').hide();

        $('#edit-phone').removeClass('is-invalid');
        $('#edit_phone_error').text(null);
        $('#edit_phone_error').hide();

        $('#edit-password').removeClass('is-invalid');
        $('#edit_password_error').text(null);
        $('#edit_password_error').hide();

        $('#edit-image').removeClass('is-invalid');
        $('#edit_image_error').text(null);
        $('#edit_image_error').hide();
    });
});

//Store admin ajax request
$(document).ready(function () {
    $(document).on('submit','#add-admin-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/admin/store',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
                // $('.image').val('');
                $('.photo').val('');
                $('#role-admin').prop('checked', true);
                $('.closeBtn').trigger('click');
                $('.dropify-clear').trigger('click');
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,
                };
                toastr['success']('admin Successfully Stored');
                appendTableRow(data);

                // remove errors
                $('#name').removeClass('is-invalid');
                $('#name_error').text(null);
                $('#name_error').hide();
                $('#email').removeClass('is-invalid');
                $('#email_error').text(null);
                $('#email_error').hide();
                $('#phone').removeClass('is-invalid');
                $('#phone_error').text(null);
                $('#phone_error').hide();
                $('#password').removeClass('is-invalid');
                $('#password_error').text(null);
                $('#password_error').hide();
                $('#image').removeClass('is-invalid');
                $('#image_error').text(null);
                $('#image_error').hide();
            },
            error: function (error) {
                console.log(error);
                // validation error showing in add admin
                if( error.responseJSON.errors.name && error.responseJSON.errors.name.length > 0){
                    $('#name').addClass('is-invalid');
                    $('#name').parent().removeClass('mb-3');
                    $('#name_error').text(error.responseJSON.errors.name['0']);
                    $('#name_error').show();
                }
                else {
                    $('#name').removeClass('is-invalid');
                    $('#name_error').text(null);
                    $('#name_error').hide();
                }

                if( error.responseJSON.errors.email && error.responseJSON.errors.email.length > 0){
                    $('#email').addClass('is-invalid');
                    $('#email').parent().removeClass('mb-3');
                    $('#email_error').text(error.responseJSON.errors.email['0']);
                    $('#email_error').show();
                }
                else {
                    $('#email').removeClass('is-invalid');
                    $('#email_error').text(null);
                    $('#email_error').hide();
                }

                if( error.responseJSON.errors.phone && error.responseJSON.errors.phone.length > 0){
                    $('#phone').addClass('is-invalid');
                    $('#phone').parent().removeClass('mb-3');
                    $('#phone_error').text(error.responseJSON.errors.phone['0']);
                    $('#phone_error').show();
                }
                else {
                    $('#phone').removeClass('is-invalid');
                    $('#phone_error').text(null);
                    $('#phone_error').hide();
                }

                if( error.responseJSON.errors.password && error.responseJSON.errors.password.length > 0){
                    $('#password').addClass('is-invalid');
                    $('#password').parent().removeClass('mb-3');
                    $('#password_error').text(error.responseJSON.errors.password['0']);
                    $('#password_error').show();
                }
                else {
                    $('#password').removeClass('is-invalid');
                    $('#password_error').text(null);
                    $('#password_error').hide();
                }

                if( error.responseJSON.errors.image && error.responseJSON.errors.image.length > 0){
                    $('#image').addClass('is-invalid');
                    $('#image').parent().removeClass('mb-3');
                    $('#image_error').text(error.responseJSON.errors.image['0']);
                    $('#image_error').show();
                }
                else {
                    $('#image').removeClass('is-invalid');
                    $('#image_error').text(null);
                    $('#image_error').hide();
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
                    url: `/admin/admin/${id}/delete`,
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
        const id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $('#admin-id').val(id);

        $.ajax({
            type: 'GET',
            url: `/admin/admin/${id}/edit`,
            success: (data) => {
                $('#edit-name').val(data.name);
                $('#edit-email').val(data.email);
                $('#edit-phone').val(data.phone);
                if(data.role_id == '1'){
                    $('#edit-role-admin').prop('checked', true);
                }
                else if(data.role_id == '2'){
                    $('#edit-role-moderator').prop('checked', true);
                }else if(data.role_id == '4'){
                    $('#edit-role-sub').prop('checked', true);
                }
                else $('#edit-role-editor').prop('checked', true);
                if(data.image){
                    $('#oldPhoto').attr('hidden',false);
                    $('#oldPhoto').attr('src',`../../uploads/admins/${data.image}`);
                }
                $('.dropify-clear').trigger('click');
            },
            error: (error) => {
                console.log(error);
            }
        })
    });
});

//Update admin Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-admin-form',function (e) {
        e.preventDefault();
        console.log( new FormData(this))

        const id = $('#admin-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/admin/${id}/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-name').val('');
                $('#edit-email').val('');
                $('#edit-phone').val('');
                $('#edit-password').val('');
                $('#edit-password_confirmation').val('');
                // $('.edit-image').val('');
                $('.edit-photo').val('');
                $('.closeBtn').trigger('click');
                $('.dropify-clear').trigger('click');
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Admin Successfully Updated!!!');
                console.log(data);
                const tr = $(tableRow).find('td');
                $(tr[0]).text(data.name);
                $(tr[1]).text(data.email);
                $(tr[2]).text(data.phone);
                $(tr[3]).text(data.role_id == '1' ? 'Admin':null || data.role_id == '2' ? 'Moderator':null || data.role_id == '3' ? 'Editor':null);
                // if image uploaded
                if(data.image){
                    console.log(tr[4].children[0])
                    // if <img> availabe
                    if(tr[4].children[0]){
                        $(tr[4].children[0]).attr('src',`../../uploads/admins/${data.image}`);
                    // if <img> unavailabe
                    }else{
                        $(tr[4]).append(`<img style="width: 80px; height: 90px" src="../../uploads/admins/${data.image}" alt="admin image">`);
                    }
    
                }

                // remove errors
                $('#edit-name').removeClass('is-invalid');
                $('#edit_name_error').text(null);
                $('#edit_name_error').hide();

                $('#edit-email').removeClass('is-invalid');
                $('#edit_email_error').text(null);
                $('#edit_email_error').hide();

                $('#edit-phone').removeClass('is-invalid');
                $('#edit_phone_error').text(null);
                $('#edit_phone_error').hide();

                $('#edit-password').removeClass('is-invalid');
                $('#edit_password_error').text(null);
                $('#edit_password_error').hide();

                $('#edit-image').removeClass('is-invalid');
                $('#edit_image_error').text(null);
                $('#edit_image_error').hide();
            },
            error: function (error) {
                console.log(error);
                // validation error showing in add admin
                if( error.responseJSON.errors.name && error.responseJSON.errors.name.length > 0){
                    $('#edit-name').addClass('is-invalid');
                    $('#edit-name').parent().removeClass('mb-3');
                    $('#edit_name_error').text(error.responseJSON.errors.name['0']);
                    $('#edit_name_error').show();
                }
                else {
                    $('#edit-name').removeClass('is-invalid');
                    $('#edit_name_error').text(null);
                    $('#edit_name_error').hide();
                }

                if( error.responseJSON.errors.email && error.responseJSON.errors.email.length > 0){
                    $('#edit-email').addClass('is-invalid');
                    $('#edit-email').parent().removeClass('mb-3');
                    $('#edit_email_error').text(error.responseJSON.errors.email['0']);
                    $('#edit_email_error').show();
                }
                else {
                    $('#edit-email').removeClass('is-invalid');
                    $('#edit_email_error').text(null);
                    $('#edit_email_error').hide();
                }

                if( error.responseJSON.errors.phone && error.responseJSON.errors.phone.length > 0){
                    $('#edit-phone').addClass('is-invalid');
                    $('#edit-phone').parent().removeClass('mb-3');
                    $('#edit_phone_error').text(error.responseJSON.errors.phone['0']);
                    $('#edit_phone_error').show();
                }
                else {
                    $('#edit-phone').removeClass('is-invalid');
                    $('#edit_phone_error').text(null);
                    $('#edit_phone_error').hide();
                }

                if( error.responseJSON.errors.password && error.responseJSON.errors.password.length > 0){
                    $('#edit-password').addClass('is-invalid');
                    $('#edit-password').parent().removeClass('mb-3');
                    $('#edit_password_error').text(error.responseJSON.errors.password['0']);
                    $('#edit_password_error').show();
                }
                else {
                    $('#edit-password').removeClass('is-invalid');
                    $('#edit_password_error').text(null);
                    $('#edit_password_error').hide();
                }

                if( error.responseJSON.errors.image && error.responseJSON.errors.image.length > 0){
                    $('#edit-image').addClass('is-invalid');
                    $('#edit-image').parent().removeClass('mb-3');
                    $('#edit_image_error').text(error.responseJSON.errors.image['0']);
                    $('#edit_image_error').show();
                }
                else {
                    $('#edit-image').removeClass('is-invalid');
                    $('#edit_image_error').text(null);
                    $('#edit_image_error').hide();
                }
            }
        })
    });
});


function appendTableRow(data) {

    $('tbody').append(`
        <tr data-id="${data.id}">
            <td>${data.name}</td>
            <td>${data.email}</td>
            <td>${data.phone}</td>
            <td>${data.role_id == '1' ? 'Admin':null || data.role_id == '2' ? 'Moderator':null || data.role_id == '3' ? 'Editor':null}</td>
            <td>
                ${ data.image ? 
                    '<img style="width: 80px; height: 90px" src="../../uploads/admins/${data.image}" alt="admin image">' : '' }
                
            </td>

            <td>
                <button data-id="${data.id}" data-toggle="modal" data-target="#editAdminModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    `);
    $('select').niceSelect();
}
