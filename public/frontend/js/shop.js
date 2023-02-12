$(function (){
    $(document).on('click','#shopSearchBtn', function (e){
        e.preventDefault();
       let searchText = $('#shopSearchInput').val();
       const shops = $('#shops');
       if (searchText !== ''){
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

           $.ajax({
               type: 'POST',
               url: '/shopsearch',
               data: {searchText: searchText},
               beforeSend: () => {
                   $('#pleaseWaitModal').modal('show');
                   setTimeout(()=>{
                       $('#pleaseWaitModal').modal('hide');
                   },2000)
               },
               success: (data) => {
                   $(shops).html('');
                   $(shops).parent().find('h4').remove();
                   $('.jscroll-added').html('');
                   if (data.length > 0) {
                       data.map(shop => {
                           $(shops).append(`
                          <div class="product-wrap">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="/shopbystore/${shop.id}">
                                            <img src="/uploads/vendors/${shop.shop_image}" width="100"
                                                height="100" />
                                        </a>

                                    </figure>
                                    <div class="product-details">
                                        <h3 class="/shopbystore/${shop.id}">
                                            <a href="/shopbystore/${shop.id}">${shop.shop_name}</a>
                                        </h3>

                                        <a style="width:100%" class="btn btn-primary" href="/shopbystore/${shop.id}"> <i class="fa fa-eye"></i>&nbsp  Visit Shop</a>

                                    </div>
                                </div>
                            </div>

                      `);
                       });
                   }else{
                       $(shops).parent().append(`
                        <h4 class="text-danger text-center">No Shop Found</h4>
                       `);
                   }
               },
               error: (errors) => {
                   console.log(errors)
               }
           })
       }
    });
})
