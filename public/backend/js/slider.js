//Store slider ajax request
$(document).ready(function () {
    $(document).on('submit','#add-slider-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/setting/storeSlider',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                // $('textarea').val('');
                // $('#subtitle').val('');
                // $('#title').val('');
                // $('#description').val('');
                $('.photo').val('');
                // $('.b_photo').val('');
                 $('#link').val('');
                // $('#position').val('');
                $('.closeBtn').click();
                $('.dropify-clear').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Slider Successfully Stored');
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
                    url: `/admin/setting/${id}/deleteSlider`,
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
        $('#slider-id').val(id);

        $.ajax({
            type: 'GET',
            url: `/admin/setting/${id}/editSlider`,
            success: (data) => {
                // $('#edit_subtitle').val(data.subtitle);
                // $('#edit_title').val(data.title);
                // $('#edit_description').val(data.description);
                $('#edit_photo').attr('src',`/storage/storeSliders/${data.image_file}`);
                // $('#edit_b_photo').attr('src',`/storage/storeSliders/${data.background_image}`);
                 $('#edit_link').val(data.link);
                // $('#edit_position').val(data.text_position).trigger('change');
                $('select').niceSelect('update');
            },
            error: (error) => {
                alert("something went wrong")
            }
        })
    });
});

//Update slider Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-slider-form',function (e) {
        e.preventDefault();
        const id = $('#slider-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/setting/${id}/updateSlider`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                // $('#edit_subtitle').val('');
                // $('#edit_title').val('');
                // $('#edit_description').val('');
                $('.edit_photo').val('');
                // $('.edit_b_photo').val('');
                 $('#edit_link').val('');
                // $('#edit_position').val('');
   
                $('.closeBtn').click();
                $('.dropify-clear').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Slide Successfully Updated!!!');
                console.log(data);
                const a = $(tableRow).find('td');
                $(a[0]).html(`<img src="\\storage\\storeSliders\\${data.image_file}" alt="image" style="width:100%" height="200px">`);
                // $(a[1]).text(data.title);
                
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
            <td style="width:100%"><img src="\\storage\\storeSliders\\${data.image_file}" alt="image" style="width:100%" height="100%"></td>
            <td>
                <button data-id="${data.id}" class="btn btn-primary btn-round mr-1 editBtn" data-toggle="modal" data-target="#editSliderModal" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="button"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    `);
    $('select').niceSelect();
}
