var tableRow = '';
//Show edit form with data ajax request
$(document).ready(function () {
    $(document).on('click','.editBtn',function () {
        const id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $('#vendor-id').val(id);
  

        $.ajax({
            type: 'GET',
            url: `/admin/vendor/${id}/edit`,
            success: (data) => {
                $('#edit-name').val(data.name);
                $('#edit-phone').val(data.phone);
                $('#edit-email').val(data.email);
                $('#edit-shop_name').val(data.shop_name);
                $('#edit-address').val(data.address);
                $('#edit-date').val(dayjs(data.created_at).format('DD/MM/YYYY') );
              
            },
            error: (error) => {
                console.log(error);
            }
        })
    });
});

//Update Category Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-vendor-form',function (e) {
        e.preventDefault();
        const id = $('#vendor-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/vendor/${id}/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-name').val('');
                $('#edit-phone').val('');
                $('.edit-email').val('');
                $('.edit-shop_name').val('');
                $('.edit-address').val('');            
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Vendor Successfully Updated!!!');

                

                $('.table-append').html(data)

            },
            error: function (error) {
                console.log(error);
                if (typeof(error.responseJSON.errors.photo) !== "undefined"){
                    $('.editCatImageError').text(error.responseJSON.errors.photo[0]);
                }else{
                    $('.editCatImageError').text('');
                }
                if (typeof(error.responseJSON.errors.image) !== "undefined"){
                    $('.editFeaturedImageError').text(error.responseJSON.errors.image[0]);
                }else{
                    $('.editFeaturedImageError').text('');
                }
            }
        })
    });
});



//Feature update ajax
$(document).ready(function () {
    // $(document).on('change', '#featureStatus', function () {
    //     let feature = $(this).val();
    //     let id = $(this).attr('data-id');
    //     $.ajax({
    //         type: 'GET',
    //         url: `/admin/vendor/${id}/feature/update`,
    //         data: { feature: feature },
    //         success: (data) => {
    //             toastr.options = {
    //                 "timeOut": "2000",
    //                 "closeButton": true,

    //             };
    //             toastr['success'](data);
    //         },
    //         error: (error) => {
    //             console.log(error);
    //         }
    //     })
    // });
    
    $(document).on('click','.yesNo',function (){
        let text = $(this).text();
        let id = $(this).attr('data-id');
        let feature = 0;
        if (text === "YES"){
            feature = 0;
            $(this).text('NO');
            $(this).removeClass('badge-success');
            $(this).addClass('badge-danger');
        }else if (text === "NO"){
            $(this).text('YES');
            $(this).removeClass('badge-danger');
            $(this).addClass('badge-success');
            feature = 1;
        }
        $.ajax({
            type: 'GET',
            url: `/admin/vendor/${id}/feature/update`,
            data: { feature: feature },
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






//Status update ajax
$(document).ready(function () {

    
    $(document).on('click','.selectStatus',function (){
        let status = 0;

        let id = $(this).attr('data-id');

        let text = $(this).text();

        if (text === "ACTIVE"){

            status = 0;

            $(this).removeClass('badge-success');
            $(this).addClass('badge-danger');
            $(this).text('DEACTIVE');

        }else if (text === "DEACTIVE"){

            status = 1;

            $(this).removeClass('badge-danger');
            $(this).addClass('badge-success');
            $(this).text('ACTIVE');

        }

        $.ajax({
            type: 'GET',
            url: `/admin/vendor/${id}/status/update`,
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

    })
});

function appendTableRow(data) {
    $('tbody').append(`

<tr>
<td>${data.name}</td>
<td>${data.email}</td>
<td>${data.phone}</td>
<td>${data.shop_name}</td>
<td>${data.address}</td>

<td>
<select name="" data-id="${data.id}" class="selectStatus">
    <option value="1"  ${data.status == 1 ? 'selected' : ''}>Active</option>
    <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
</select>
</td>
<td>
    <a  href="#"
        class="btn btn-primary btn-round deleteBtn" style="cursor: pointer"
        type="submit"><i class="fa fa-edit"></i> Edit</a>
    <a  href="#"
        class="btn btn-danger btn-round deleteBtn" style="cursor: pointer"
        type="submit"><i class="fa fa-trash"></i></a>
</td>
</tr>
    `);
    $('select').niceSelect();
}


//Delete Vendor
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
                    url: `/admin/vendor/${id}/delete`,
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
