$(function () {
    $(document).on('click', '.product_category1', function (e) {
        e.preventDefault();
        const catId = $(this).attr('data-id');
        const allProductSection = $('#all_products');
        const vendorId = $('#vendor_id').val();
        $.ajax({
            type: 'GET',
            url: `/shop/category/${catId}/${vendorId}/product`,
            beforeSend: () => {
                $('#pleaseWaitModal').modal('show');
                setTimeout(()=>{
                    $('#pleaseWaitModal').modal('hide');
                },2000)
            },
            success: (data) => {
                $('.jscroll-added').html('');
                $('.infinite-scroll').jscroll({
                    autoTrigger: false,
                });
                
                $(allProductSection).html('');
                $('.widget-body').css('display','none');
                $('.widget-title').addClass('collapsed');
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
                            stock = `<div class="product-action-vertical">
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

                        let productPrice = `
                                <div class="product-price">
                                        TK <ins class="new-price">${product.price}</ins><del class="old-price">${product.previous_price}</del>
                                    </div>
                                `;
                    
                        
                        let flashSale = '';
                        if(product.offer_product == 1){
                            flashSale = `
                            <div class="badge-overlay">
                        <span class="top-left badge pink">SALE</span>
                         </div>
                            `
                        }
                        
                        let onlinePayment = '';
                        if(product.online_payment == 1){
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                            </div>
                            `
                        }else{
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                            </div>
                            `
                        }

                        $(allProductSection).append(`
                        <div class="col-md-2 col-sm-4 col-xs-6">

                                            <div class="product-wrap mt-2">
                                                <div  class="product border shadow text-center">
                                                    <figure class="product-media">
                                                        <a href="/productdetails/${product.slug}">
                                                                <img style="height:200px" src="/../../${product.photo}" alt="Product" width="300"
                                                                    height="338">
                                                                <img style="height:200px" src="/../../${product.photo}" alt="Product" width="300"
                                                                    height="338">
                                                            </a>
                                                            ${stock}
                                                            ${onlinePayment}
                                                    </figure>
                                                    ${flashSale}
                                                    <div class="product-details">
                                                        <h3 class="product-name">
                                                            <a href="/productdetails/${product.slug}">${product.name}</a>
                                                        </h3>
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
                                        </div>
                   `);
                    });
                } else {
                    $(allProductSection).append(`
                        <h4 class="text-danger text-center">Product Not found</h4>
                   `);
                }
            },
            error: (error) => console.log(error)
        })
    })
});

$(function () {
    $(document).on('click', '#searchUl li', function (e) {
        e.preventDefault();
        const allProductSection = $('#all_products');
        let a = $(this).text().replace('Tk.', '');
        let b = a.replace('+', '');
        let c = b.split("-");
        let first = c[0];
        let second = c[1];
        let vendorId = $('#vendor_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/shop/product/${vendorId}/price-filter`,
            data: {first: first, second: second},
            beforeSend: () => {
                $('#pleaseWaitModal').modal('show');
                setTimeout(()=>{
                    $('#pleaseWaitModal').modal('hide');
                },2000)
            },
            success: (data) => {
              
                $('.jscroll-added').html('');
                $('.infinite-scroll').jscroll({
                    autoTrigger: false,
                });
                
                $('.widget-body').css('display','none');
                $('.widget-title').addClass('collapsed');
                $(allProductSection).html('');
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
                            stock = `<div class="product-action-vertical">
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

                        let productPrice = `
                                <div class="product-price">
                                        TK <ins class="new-price">${product.price}</ins><del class="old-price">${product.previous_price}</del>
                                    </div>
                                `;
                        
                        let flashSale = '';
                        if(product.offer_product == 1){
                            flashSale = `
                            <div class="badge-overlay">
                        <span class="top-left badge pink">SALE</span>
                         </div>
                            `
                        }
                        
                        let onlinePayment = '';
                        if(product.online_payment == 1){
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                            </div>
                            `
                        }else{
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                            </div>
                            `
                        }

                        $(allProductSection).append(`
                        <div class="col-md-2 col-sm-4 col-xs-6">

                                            <div class="product-wrap mt-2">
                                                <div  class="product border shadow text-center">
                                                    <figure class="product-media">
                                                        <a href="/productdetails/${product.slug}">
                                                                <img style="height:200px" src="/../../${product.photo}" alt="Product" width="300"
                                                                    height="338">
                                                                <img style="height:200px" src="/../../${product.photo}" alt="Product" width="300"
                                                                    height="338">
                                                            </a>
                                                            ${stock}
                                                            ${onlinePayment}
                                                    </figure>
                                                    ${flashSale}
                                                    <div class="product-details">
                                                        <h3 class="product-name">
                                                            <a href="/productdetails/${product.slug}">${product.name}</a>
                                                        </h3>
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
                                        </div>
                   `);
                    });
                } else {
                    $(allProductSection).append(`
                        <h4 class="text-danger text-center">Product Not found</h4>
                   `);
                }
            },
            error: (error) => {
                console.log(error);
            }
        })
    });
})

$(function(){
    $(document).on('click','.goBtn',function (e){
        e.preventDefault();
        let first = $('.min_price').val();
        let second = $('.max_price').val();
        let allProductSection = $('#all_products');
        const vendorId = $('#vendor_id').val();
        if (first === ''){
            first = 0;
        }
        if (second === ''){
            second = 10000000;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/shop/product/${vendorId}/price-filter`,
            data: {first: first, second: second},
            beforeSend: () => {
                $('#pleaseWaitModal').modal('show');
                setTimeout(()=>{
                    $('#pleaseWaitModal').modal('hide');
                },2000)
            },
            success: (data) => {
                $('.jscroll-added').html('');
                $('.infinite-scroll').jscroll({
                    autoTrigger: false,
                });
                
                $('.widget-body').css('display','none');
                $('.widget-title').addClass('collapsed');
                $(allProductSection).html('');
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
                            stock = `<div class="product-action-vertical">
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

                        let productPrice = `
                                <div class="product-price">
                                        TK <ins class="new-price">${product.price}</ins><del class="old-price">${product.previous_price}</del>
                                    </div>
                                `;
                        
                        let flashSale = '';
                        if(product.offer_product == 1){
                            flashSale = `
                            <div class="badge-overlay">
                        <span class="top-left badge pink">SALE</span>
                         </div>
                            `
                        }
                        
                        let onlinePayment = '';
                        if(product.online_payment == 1){
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                            </div>
                            `
                        }else{
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                            </div>
                            `
                        }

                        $(allProductSection).append(`
                        <div class="col-md-2 col-sm-4 col-xs-6">

                                            <div class="product-wrap mt-2">
                                                <div  class="product border shadow text-center">
                                                    <figure class="product-media">
                                                        <a href="/productdetails/${product.slug}">
                                                                <img style="height:200px" src="/../../${product.photo}" alt="Product" width="300"
                                                                    height="338">
                                                                <img style="height:200px" src="/../../${product.photo}" alt="Product" width="300"
                                                                    height="338">
                                                            </a>
                                                            ${stock}
                                                            ${onlinePayment}
                                                    </figure>
                                                    ${flashSale}
                                                    <div class="product-details">
                                                        <h3 class="product-name">
                                                            <a href="/productdetails/${product.slug}">${product.name}</a>
                                                        </h3>
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
                                        </div>
                   `);
                    });
                } else {
                    $(allProductSection).append(`
                        <h4 class="text-danger text-center">Product Not found</h4>
                   `);
                }
            },
            error: (error) => {
                console.log(error);
            },
            complete: () => {
                $('#pleaseWaitModal').modal('hide');
            },
        })

    });
});

