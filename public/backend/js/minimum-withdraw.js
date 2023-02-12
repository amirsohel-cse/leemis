//Store minimum witdraw ajax request
$(document).ready(function () {
    $(document).on('click','#add_btn',function (){
        $.ajax({
            type: 'GET',
            url: '/admin/vendor/edit/minimum-withdraw',
            success: (data) => {
                console.log(data.min_withdraw_amount)
                if (data){
                    $('#formAmount').val(data.min_withdraw_amount);
                }
            }
        })
    })

    $(document).on('submit','#add-withdraw-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/vendor/storeMinimumWithdraw',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#amount').val('');
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Minimum Withdraw Amount Successfully Stored');
                appendTableRow(data);
            },
            error: function (error) {
                console.log(error);
                if (typeof(error.responseJSON.errors.amount) !== "undefined"){
                    $('.error').text(error.responseJSON.errors.amount[0]);
                }else{
                    $('.error').text('');
                }
                $('.error').text(error.responseJSON.errors.amount[0]);
            }
        })
    });
});

//Update service Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-withdraw-form',function (e) {
        e.preventDefault();
        const id = $('#withdraw-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/vendor/update/${id}/minimum-withdraw`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-amount').val('');
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Minimum Withdraw Amount Successfully Updated');
                console.log(data);
                const a = $(tableRow).find('td');
                $(a[0]).text(data.id);
                $(a[1]).text(data.min_withdraw_amount);


            },
            error: function (error) {
                alert("something Wrong")
                console.log(error);
            }
        })
    });
});


function appendTableRow(data) {
    $('tbody').html(`
        <tr data-id="${data.id}">
            <td>${data.id}</td>
            <td>${data.min_withdraw_amount}</td>
        </tr>
    `);

}
