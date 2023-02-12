$(function (){
    $(document).on('click','#brandProductSearchBtn',function (){
        const brandId = $('#brandId').val();
        const searchText = $('#brandProductSearchInput').val();
        const brandProductList = $('#brandProductList');
        if (searchText !== ''){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: `/${brandId}/brandproductsearch/`,
                data: {searchText: searchText},
                success: (data) => {
                    $(brandProductList).html('');
                    if (data.length > 0) {
                        data.forEach((product) => {
                            let stock = '';
                            let cartBtn = '';
                            let rating1 = '';
                            let rating2 = '';
                            let rating3 = '';
                            let rating4 = '';
                            let rating5 = '';
                            let rating6 = '';
                            let reviews = 0;
                            if (product.stock > 0) {
                                stock = `<div class="product-action-horizontal">
                                        <a href="#" data-id="${product.id}" class="btn-product-icon btn-wishlist w-icon-heart"
                                           title="Add to wishlist"></a>
                                    </div>`
                                cartBtn = `<a style="width:100%" data-id="${product.id}" class="btn btn-primary btn-cart" href="#">
                                        <i class="fas fa-shopping-cart"></i>&nbsp  Buy Now</a>`
                            } else {
                                cartBtn = `<button style="width: 100%; background-color: darkred; color: white" type="button" class="btn btn-danger" disabled>
                                            <i class="fas fa-shopping-cart"></i>&nbsp  Out of Stock</button>`
                            }

                            if (Math.ceil(parseFloat(product.avg_rating)) > 0){
                                rating1 = `<span class="ratings" style="width: 0%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0){
                                rating2 = `<span class="ratings" style="width: 20%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0){
                                rating3 = `<span class="ratings" style="width: 40%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0){
                                rating4 = `<span class="ratings" style="width: 60%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0){
                                rating5 = `<span class="ratings" style="width: 80%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0){
                                rating6 = `<span class="ratings" style="width: 100%;"></span>`
                            }

                            if (product.ratings.length > 0){
                                reviews = product.ratings.length;
                            }

                            let productPrice = '';
                            if (product.offer_product == 1){
                                productPrice = `
                                <div class="product-price">
                                        <ins class="new-price">${product.previous_price}</ins><del class="old-price">${product.price}</del>
                                    </div>
                                `
                            }else{
                                productPrice = `
                                <div class="product-price">
                                    <ins class="new-price">${product.price}</ins>
                                    </div>
                                `;
                            }

                            $(brandProductList).append(`
                        <div class="product-wrap">
                            <div class="product border shadow text-center">
                                <figure class="product-media">
                                    <a href="/productdetails/${product.slug}">
                                            <img style="height:200px" src="${product.photo}" alt="Product" width="300"
                                                height="338">
                                            <img style="height:200px" src="${product.photo}" alt="Product" width="300"
                                                height="338">
                                        </a>
                                        ${stock}
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="/productdetails/${product.slug}">${product.name}</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            ${rating1}
                                            ${rating2}
                                            ${rating3}
                                            ${rating4}
                                            ${rating5}
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="#" class="rating-reviews">(

                                            ${reviews}
                                            Reviews
                                            )</a>
                                    </div>
                                    ${productPrice}
                                    ${cartBtn}
                            </div>

                            </div>
                        </div>
                   `);
                        });
                    } else {
                        $(brandProductList).append(`
                        <h4 class="text-danger text-center">Product Not found</h4>
                   `);
                    }
                },
            })
        }

    })
})
