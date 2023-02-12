
// remove validation errors when close the moadal
$(function(){
    $("#withdrawModal").on('hide.bs.modal', function(){
        // remove errors
        $('#amount').removeClass('is-invalid');
        $('#amount_error').text(null);
        $('#amount_error').hide();
        $('#withmethod').val('');
        $('#amount').val('');
        $('#iban').val('');
        $('#acc_name').val('');
        $('#routing_number').val('');
        $('swift').val('');
        $('bankname').val('');
    });
});

$(document).ready(function () {
    $(document).on('submit','#add-withdraw-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (navigator.onLine){
            $.ajax({
                type: 'POST',
                url: 'vendorWithdraws',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data)
                    $('#withmethod').val('');
                    $('#amount').val('');
                    $('#iban').val('');
                    $('#acc_name').val('');
                    $('#routing_number').val('');
                    $('swift').val('');
                    $('bankname').val('');

                    toastr.options = {
                        "timeOut": "2000",
                        "closeButton": true,
                    };

                    appendTableRow(data['0']);
                    $('.closeBtn').trigger('click');
                    toastr['success']('Withdraw request successful');

                    $('#curr_bal').replaceWith('Current Balance : '+data['1']);

                // remove errors
                $('#amount').removeClass('is-invalid');
                $('#amount_error').text(null);
                $('#amount_error').hide();
            },
            error: function (error) {
                console.log(error);
                // validation error showing
                if( error.responseJSON == "balance_error"){
                    $('#amount').addClass('is-invalid');
                    $('#amount').parent().removeClass('mb-3');
                    $('#amount_error').text("Withdraw amount can not be greater than Current Balance");
                    $('#amount_error').show();
                }
                else if( error.responseJSON.minimum_withdraw){
                    $('#amount').addClass('is-invalid');
                    $('#amount').parent().removeClass('mb-3');
                    $('#amount_error').text("Withdraw amount must be greater than or equal "+ error.responseJSON.minimum_withdraw.amount + " Tk");
                    $('#amount_error').show();
                }
                else if( error.responseJSON.errors.amount && error.responseJSON.errors.amount.length > 0){
                    $('#amount').addClass('is-invalid');
                    $('#amount').parent().removeClass('mb-3');
                    $('#amount_error').text(error.responseJSON.errors.amount['0']);
                    $('#amount_error').show();
                }            
                  
                else {
                    $('#amount').removeClass('is-invalid');
                    $('#amount_error').text(null);
                    $('#amount_error').hide();
                }
            }
            });
        }else{
            Swal.fire({
                title: 'No Internet Connection!',
                text: 'You are in offline mode! Check your internet connection.',
                icon: 'error',
                confirmButtonText: 'Okay'
            })
        }

    });
});

function appendTableRow(data) {
console.log('append')
    $('tbody').append(`
        <tr data-id="${data.id}">
            <td>${data.created_at}</td>
            <td>${data.method}</td>
            <td>${data.account_no}</td>
            <td>${data.amount}</td>
            <td><span class="badge bg-warning text-white">${data.status}</span></td>
        </tr>
    `);
}
