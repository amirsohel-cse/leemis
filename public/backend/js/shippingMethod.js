$(document).ready(function () {
    $(document).on('click','#addMethodBtn',function () {
        $('.feature-brand').attr('hidden',true);
        $('.dropify-clear').click();

        $('.titleError').text('');
        $('.priceError').text('');
    });
});

//Store brand ajax request
$(document).ready(function () {
    $(document).on('submit','#add-method-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "/admin/setting/addShipping",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#title').val('');
                $('#price').val('');
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Method Successfully Stored');
                appendTableRow(data);
            },
            error: function (error) {
                console.log(error);
                if (typeof(error.responseJSON.errors.title) !== "undefined"){
                    $('.titleError').text(error.responseJSON.errors.title[0]);
                }else{
                    $('.titleError').text('');
                }

                if (typeof(error.responseJSON.errors.price) !== "undefined"){
                    $('.priceError').text(error.responseJSON.errors.price[0]);
                }else{
                    $('.priceError').text('');
                }

                $('.priceError').text(error.responseJSON.errors.amount[0]);
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
                    url: `/admin/setting/${id}/deleteShipping`,
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
        $('.titleError').text('');
        $('.priceError').text('');
        const id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $('#method-id').val(id);

        $.ajax({
            type: 'GET',
            url: `/admin/setting/${id}/editShipping`,
            success: (data) => {
                $('#edit-title').val(data.title);
                $('#edit-price').val(data.price);
            },
            error: (error) => {
                alert("somthing went wrong")
                console.log(error);
            }
        })
    });
});

//Update brand Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-method-form',function (e) {
        e.preventDefault();
        const id = $('#method-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/setting/${id}/updateShipping`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-title').val('');
                $('#edit-price').val('');
                $('.closeBtn').click();
          
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Method Successfully Updated!!!');
                console.log(data);
                const a = $(tableRow).find('td');
                $(a[0]).text(data.title);
                $(a[1]).text(data.price);


            },
            error: function (error) {
                if (typeof(error.responseJSON.errors.title) !== "undefined"){
                    $('.titleError').text(error.responseJSON.errors.title[0]);
                }else{
                    $('.titleError').text('');
                }

                if (typeof(error.responseJSON.errors.price) !== "undefined"){
                    $('.priceError').text(error.responseJSON.errors.price[0]);
                }else{
                    $('.priceError').text('');
                }

                $('.priceError').text(error.responseJSON.errors.amount[0]);
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
            url: `/admin/setting/${id}/status/updateShippingStatus`,
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

function appendTableRow(data) {
    $('tbody').append(`
        <tr data-id="${data.id}">
            <td>${data.title}</td>
            <td>${data.price}</td>

            <td>
                <select class="theme-bg"  data-id="${data.id}" name="" id="selectStatus">
                    <option value="1" ${data.status == 1 ? 'selected' : ''}>Active</option>
                    <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
                </select>
            </td>
            <td>
                <button data-id="${data.id}" class="btn btn-primary btn-round mr-1 editBtn" data-toggle="modal" data-target="#editMethodModal" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="button"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    `);
    $('select').niceSelect();
}
