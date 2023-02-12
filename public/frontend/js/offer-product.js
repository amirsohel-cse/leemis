$(function () {

    $(document).on('click', '.product_category1', function (e) {
        e.preventDefault();
        const catId = $(this).attr('data-id');
        const allProductSection = $('#all_products');
        $.ajax({
            type: 'GET',
            url: `/offer-category/${catId}/products`,
            beforeSend: () => {
                $('#pleaseWaitModal').modal('show');
                setTimeout(() => {
                    $('#pleaseWaitModal').modal('hide');
                }, 2000)
            },
            success: (data) => {




                $('.jscroll-added').html('');
                $('.infinite-scroll').jscroll({
                    autoTrigger: true,
                });

                $('.widget-body').css('display', 'none');
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
                                            <i class="fas fa-shopping-cart"></i>&nbsp  Stock Out</button>`
                        }

                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating1 = `<span class="ratings" style="width: 0%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating2 = `<span class="ratings" style="width: 20%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating3 = `<span class="ratings" style="width: 40%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating4 = `<span class="ratings" style="width: 60%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating5 = `<span class="ratings" style="width: 80%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating6 = `<span class="ratings" style="width: 100%;"></span>`
                        }

                        if (product.ratings.length > 0) {
                            reviews = product.ratings.length;
                        }

                        let flashSale = '';
                        if (product.offer_product == 1) {
                            flashSale = `
                            <div class="badge-overlay">
                        <span class="top-left badge pink">SALE</span>
                         </div>
                            `
                        }

                        let onlinePayment = '';
                        if (product.online_payment == 1) {
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                            </div>
                            `
                        } else {
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                            </div>
                            `
                        }

                        $(allProductSection).append(`


                        <div class="col-md-3 col-sm-4 col-6  single-offer-product">

                                            <div class="product-wrap ">
                                                <div class="product border">
                                                    <figure class="product-media">
                                                        <a
                                                            href="/productdetails/${product.slug}">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                        </a>

                                                        ${stock}
                                                        ${onlinePayment}
                                                        

                                                        <div class="shopping-action">
                                                            ${cartBtn}
                                                        </div>

                                                       
                                                    </figure>
                                                    <div class="badge-overlay">
                                                        <span class="top-left badge pink">SALE</span>
                                                    </div>
                                                    <div class="product-details">
                                                        <h3 class="product-name mb-1">
                                                            <a
                                                                href="/productdetails/${product.slug}">${product.name}</a>
                                                        </h3>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                            ${rating1}
                                                            ${rating2}
                                                            ${rating3}
                                                            ${rating4}
                                                            ${rating5}
                                                            ${rating6}
                                                               
                                                            </div>
                                                            <a href="#" class="rating-reviews">(

                                                                ${reviews}

                                                                Reviews
                                                                )
                                                            </a>
                                                        </div>
                                                        <div class="product-price">
                                                            TK <ins class="new-price">${product.previous_price}</ins><del
                                                                class="old-price">${product.price}</del>
                                                        </div>
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
        });
    })
});

$(function () {
    $(document).on('click', '#priceUl li', function (e) {
        e.preventDefault();
        const allProductSection = $('#all_products');
        let a = $(this).text().replace('Tk.', '');
        let b = a.replace('+', '');
        let c = b.split("-");
        let first = c[0];
        let second = c[1];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/offer-product/price-filter',
            data: { first: first, second: second },
            beforeSend: () => {
                $('#pleaseWaitModal').modal('show');
                setTimeout(() => {
                    $('#pleaseWaitModal').modal('hide');
                }, 2000)
            },
            success: (data) => {
                $('.jscroll-added').html('');
                $('.infinite-scroll').jscroll({
                    autoTrigger: true,
                });

                $('.widget-body').css('display', 'none');
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
                                            <i class="fas fa-shopping-cart"></i>&nbsp  Stock Out</button>`
                        }

                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating1 = `<span class="ratings" style="width: 0%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating2 = `<span class="ratings" style="width: 20%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating3 = `<span class="ratings" style="width: 40%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating4 = `<span class="ratings" style="width: 60%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating5 = `<span class="ratings" style="width: 80%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating6 = `<span class="ratings" style="width: 100%;"></span>`
                        }

                        if (product.ratings.length > 0) {
                            reviews = product.ratings.length;
                        }

                        let onlinePayment = '';
                        if (product.online_payment == 1) {
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                            </div>
                            `
                        } else {
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                            </div>
                            `
                        }

                        $(allProductSection).append(`
                        <div class="col-md-3 col-sm-4 col-6  single-offer-product">

                                            <div class="product-wrap ">
                                                <div class="product border">
                                                    <figure class="product-media">
                                                        <a
                                                            href="/productdetails/${product.slug}">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                        </a>

                                                        ${stock}
                                                        ${onlinePayment}
                                                        

                                                        <div class="shopping-action">
                                                            ${cartBtn}
                                                        </div>

                                                       
                                                    </figure>
                                                    <div class="badge-overlay">
                                                        <span class="top-left badge pink">SALE</span>
                                                    </div>
                                                    <div class="product-details">
                                                        <h3 class="product-name mb-1">
                                                            <a
                                                                href="/productdetails/${product.slug}">${product.name}</a>
                                                        </h3>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                            ${rating1}
                                                            ${rating2}
                                                            ${rating3}
                                                            ${rating4}
                                                            ${rating5}
                                                            ${rating6}
                                                               
                                                            </div>
                                                            <a href="#" class="rating-reviews">(

                                                                ${reviews}

                                                                Reviews
                                                                )
                                                            </a>
                                                        </div>
                                                        <div class="product-price">
                                                            TK <ins class="new-price">${product.previous_price}</ins><del
                                                                class="old-price">${product.price}</del>
                                                        </div>
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

$(function () {
    $(document).on('click', '.goBtn', function (e) {
        e.preventDefault();
        let first = $('.min_price').val();
        let second = $('.max_price').val();
        let allProductSection = $('#all_products');
        if (first === '') {
            first = 0;
        }
        if (second === '') {
            second = 10000000;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/offer-product/price-filter',
            data: { first: first, second: second },
            beforeSend: () => {
                $('#pleaseWaitModal').modal('show');
                setTimeout(() => {
                    $('#pleaseWaitModal').modal('hide');
                }, 2000)
            },
            success: (data) => {
                $('.jscroll-added').html('');
                $('.infinite-scroll').jscroll({
                    autoTrigger: true,
                });

                $('.widget-body').css('display', 'none');
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
                                            <i class="fas fa-shopping-cart"></i>&nbsp  Stock Out</button>`
                        }

                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating1 = `<span class="ratings" style="width: 0%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating2 = `<span class="ratings" style="width: 20%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating3 = `<span class="ratings" style="width: 40%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating4 = `<span class="ratings" style="width: 60%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating5 = `<span class="ratings" style="width: 80%;"></span>`
                        }
                        if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                            rating6 = `<span class="ratings" style="width: 100%;"></span>`
                        }

                        if (product.ratings.length > 0) {
                            reviews = product.ratings.length;
                        }

                        let onlinePayment = '';
                        if (product.online_payment == 1) {
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                            </div>
                            `
                        } else {
                            onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                            </div>
                            `
                        }

                        $(allProductSection).append(`
                        <div class="col-md-3 col-sm-4 col-6  single-offer-product">

                                            <div class="product-wrap ">
                                                <div class="product border">
                                                    <figure class="product-media">
                                                        <a
                                                            href="/productdetails/${product.slug}">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                        </a>

                                                        ${stock}
                                                        ${onlinePayment}
                                                        

                                                        <div class="shopping-action">
                                                            ${cartBtn}
                                                        </div>

                                                       
                                                    </figure>
                                                    <div class="badge-overlay">
                                                        <span class="top-left badge pink">SALE</span>
                                                    </div>
                                                    <div class="product-details">
                                                        <h3 class="product-name mb-1">
                                                            <a
                                                                href="/productdetails/${product.slug}">${product.name}</a>
                                                        </h3>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                            ${rating1}
                                                            ${rating2}
                                                            ${rating3}
                                                            ${rating4}
                                                            ${rating5}
                                                            ${rating6}
                                                               
                                                            </div>
                                                            <a href="#" class="rating-reviews">(

                                                                ${reviews}

                                                                Reviews
                                                                )
                                                            </a>
                                                        </div>
                                                        <div class="product-price">
                                                            TK <ins class="new-price">${product.previous_price}</ins><del
                                                                class="old-price">${product.price}</del>
                                                        </div>
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



    // custom

    $('.checkBoxFilter').each(function () {
        $(this).on('click', function () {
            const allProductSection = $('#all_products');
            $.ajax({
                method: "GET",
                url: "newarrival/fileterbytime",
                data: { duration: $(this).val() },
                success: function (data) {

                  

                    $('.jscroll-added').html('');
                    $('.infinite-scroll').jscroll({
                        autoTrigger: true,
                    });

                    $('.widget-body').css('display', 'none');

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
                                            <i class="fas fa-shopping-cart"></i>&nbsp  Stock Out</button>`
                            }

                            if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                                rating1 = `<span class="ratings" style="width: 0%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                                rating2 = `<span class="ratings" style="width: 20%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                                rating3 = `<span class="ratings" style="width: 40%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                                rating4 = `<span class="ratings" style="width: 60%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                                rating5 = `<span class="ratings" style="width: 80%;"></span>`
                            }
                            if (Math.ceil(parseFloat(product.avg_rating)) > 0) {
                                rating6 = `<span class="ratings" style="width: 100%;"></span>`
                            }

                            if (product.ratings.length > 0) {
                                reviews = product.ratings.length;
                            }

                            let flashSale = '';
                            if (product.offer_product == 1) {
                                flashSale = `
                            <div class="badge-overlay">
                        <span class="top-left badge pink">SALE</span>
                         </div>
                            `
                            }

                            let onlinePayment = '';
                            if (product.online_payment == 1) {
                                onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                            </div>
                            `
                            } else {
                                onlinePayment = `
                            <div class="product-action-horizontal">
                              <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                            </div>
                            `
                            }

                            $(allProductSection).append(`


                        <div class="col-md-3 col-sm-4 col-6  single-offer-product">

                                            <div class="product-wrap ">
                                                <div class="product border">
                                                    <figure class="product-media">
                                                        <a
                                                            href="/productdetails/${product.slug}">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                            <img style="height:200px; width:100%;"
                                                                src="${product.photo}" alt="Product">
                                                        </a>

                                                        ${stock}
                                                        ${onlinePayment}
                                                        

                                                        <div class="shopping-action">
                                                            ${cartBtn}
                                                        </div>

                                                       
                                                    </figure>
                                                    <div class="badge-overlay">
                                                        <span class="top-left badge pink">SALE</span>
                                                    </div>
                                                    <div class="product-details">
                                                        <h3 class="product-name mb-1">
                                                            <a
                                                                href="/productdetails/${product.slug}">${product.name}</a>
                                                        </h3>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                            ${rating1}
                                                            ${rating2}
                                                            ${rating3}
                                                            ${rating4}
                                                            ${rating5}
                                                            ${rating6}
                                                               
                                                            </div>
                                                            <a href="#" class="rating-reviews">(

                                                                ${reviews}

                                                                Reviews
                                                                )
                                                            </a>
                                                        </div>
                                                        <div class="product-price">
                                                            TK <ins class="new-price">${product.previous_price}</ins><del
                                                                class="old-price">${product.price}</del>
                                                        </div>
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
})


});

