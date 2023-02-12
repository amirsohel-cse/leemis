$(function (){
    $(document).on('click','#brandSearchBtn',function (){
        let searchText = $('#brandSearchInput').val();
        search(searchText);
    });
})

function search(text){
    let searchText = text;
    const brandList = $('#brandList');
    const productWrapper = $('.product-wrapper');
    if (searchText !== ''){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/brandsearch',
            data: {searchText: searchText},
            beforeSend: () => {
                $('#pleaseWaitModal').modal('show');
                setTimeout(()=>{
                    $('#pleaseWaitModal').modal('hide');
                },2000)
            },
            success: (data) => {
                $(brandList).html('');
                $(brandList).parent().find('h4').remove();
                $('.jscroll-added').html('');
                if (data.length > 0){
                    data.map(brand => {
                        $(brandList).append(`
                                <div  class="product-wrap  brands-home square bg-white rounded p-3">
                                     <a href="/brandbyproduct/${brand.id}">
                                        <img style="margin-top:10px;height:150px" src="/uploads/brand-images/${brand.photo}" alt="" width="300"
                                             height="338">
                                     </a>  <br> <br>
                                    <a href="/brandbyproduct/${brand.id}"><h4>${brand.name}</h4></a>
                                </div>
                           `);
                    });
                }else{
                    $(brandList).parent().append(`
                            <h4 class="text-danger text-center">No Brands Found</h4>
                        `);
                }
            },
            error: (error) => {console.log(error)},
        })
    }
}
