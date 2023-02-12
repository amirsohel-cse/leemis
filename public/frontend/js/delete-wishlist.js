$(function () {
    $(document).on('click','.btn-close',function () {
        const id = $(this).attr('data-id');
        const wishListRow = $(this).parent().parent().parent();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'DELETE',
            url: `/wishlilst/${id}/delete`,
            success: (data) => {
                $(wishListRow).remove();
                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['error'](data);
                
                let wishlist = parseInt($('.wish-count').text());
                if(wishlist > 0){
                    $('.wish-count').text(wishlist - 1);
                }
                    
            }
        })
    });
});
