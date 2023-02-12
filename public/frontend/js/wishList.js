$(function () {
    $(document).on('click','.btn-wishlist',function () {
        const userId = $('#userId').val();
        if (userId === ''){
            toastr.options = {
                "timeOut": "3000",
                "closeButton": true,
            };
            toastr['error']('You have to login first');
        }else{
            const id = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: `/wishlist/${id}/saveWishList`,
                data: {user_id: userId},
                success: (data)=>{
                    toastr.options = {
                        "timeOut": "3000",
                        "closeButton": true,
                    };
                    toastr['success'](data.message);
                    
                    let wishlist = parseInt($('.wish-count').text());
                    
                    if(data.newWishList == 1){
                        $('.wish-count').text(wishlist + 1);
                    }
                   
                    
                },
                error: (errors) => {

                }
            })
        }
    });
});
