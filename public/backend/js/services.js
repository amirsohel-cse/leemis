//Store service ajax request
$(document).ready(function () {
    $(document).on('submit','#add-service-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/setting/storeService',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#title').val('');
                $('#details').val('');
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Service Successfully Stored');
                appendTableRow(data);
            },
            error: function (error) {
                alert("something wrong")
                console.log(error);
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
                    url: `/admin/setting/${id}/deleteService`,
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

//edit
var tableRow = '';
$(document).ready(function () {
    $(document).on('click','.editBtn',function () {
        const id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $('#service-id').val(id);

        $.ajax({
            type: 'GET',
            url: `/admin/setting/${id}/editService`,
            success: (data) => {
                $('#edit-title').val(data.title);
                $('#edit-details').val(data.details);
            },
            error: (error) => {
                alert("something went wrong")
                console.log(error);
            }
        })
    });
});

//Update service Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-service-form',function (e) {
        e.preventDefault();
        const id = $('#service-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/setting/${id}/updateService`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-title').val('');
                $('#edit-details').val('');
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Service Successfully Updated!!!');
                console.log(data);
                const a = $(tableRow).find('td');
                $(a[0]).text(data.title);
                $(a[1]).text(data.details);


            },
            error: function (error) {
                alert("something Wrong")
                console.log(error);
            }
        })
    });
});


function appendTableRow(data) {
    $('tbody').append(`
        <tr data-id="${data.id}">
            <td>${data.title}</td>
            <td>${data.details}</td>
            <td>
                <button data-id="${data.id}" class="btn btn-primary btn-round mr-1 editBtn" data-toggle="modal" data-target="#editServiceModal" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="button"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    `);
   
}
