function init_carousel() {
   $('.owl-carousel').owlCarousel();
};

$(document).ready(function () {
    $(document).on('click', '.btn-quickview', function () {
        const id = $(this).attr('data-id');
        const productCarousel = $('#quick-view-carousel');
        const thumbnailImage = $('#quick-view-thumbs');
        const productTitle = $('.product-title');
        const brandImage = $('.brand img');
        const productCategory = $('.product-category-text');
        const productSku = $('.product-sku-text');
        const productPrice = $('.product-price-text');
        const productPriceBottom = $('.product-price-text-bottom');
        const productShortDesc = $('.product-short-desc');
        const cartBtn = $('#btn-cart');
        const productSize = $('#size-variation');
        const productColor = $('#color-variation');
        $('#productSize').val('');
        $('#productColor').val('');
        $('#productQty').val('');
        $('.pvp').attr('hidden',true);

        $(productCarousel).html('');
        $(thumbnailImage).html('');
        $(productTitle).html('');
        $(brandImage).attr('src','');
        $(productCategory).text('');
        $(productSku).text('');
        $(productPrice).text('');
        $(productShortDesc).html('');
        $(productSize).html('');
        $(cartBtn).attr('data-id','');
        $(productPriceBottom).text('');
        $(productColor).html('');

        $.ajax({
            type: 'GET',
            url: `/${id}/details`,
            success: (data) => {
                //appending the product images
                $(productCarousel).append(`
                    <figure class="product-image">
                        <img src="../../${data.photo}"
                             data-zoom-image="../../${data.photo}"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                `);
                $(thumbnailImage).append(`
                    <div class="product-thumb active">
                                <img src="../../${data.photo}" alt="Product Thumb" width="103"
                                    height="116">
                    </div>
                `)

                if (data.galleries.length > 0){
                    let i = 0;
                    data.galleries.map(image => {
                            $(thumbnailImage).append(`
                            <div class="product-thumb">
                                <img src="../../uploads/product-gallery/${image.image_file}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                            `);
                        $(productCarousel).append(`
                    <figure class="product-image">
                        <img src="../../uploads/product-gallery/${image.image_file}"
                             data-zoom-image="../../uploads/product-gallery/${image.image_file}"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                `);

                    })
                }

                //Product title:
                $(productTitle).text(data.name);
                //Brand Image:
                $(brandImage).attr('src',`../../uploads/brand-images/${data.brand.photo}`);
                //Product Category:
                $(productCategory).text(data.categories.name.toUpperCase());
                //product SKU:
                $(productSku).text(data.sku.toUpperCase());
                //Product price:
                $(productPrice).text(data.price);
                $(productPriceBottom).text(data.price);
                //product short description
                $(productShortDesc).html(data.details);
                //product sizes
                if (data.size !== ','){
                    $('.product-size-swatch').attr('hidden',false);
                    let productSizes = data.size.split(',');
                    productSizes.map(size => {
                        if (size !== ''){
                            $(productSize).append(`
                            <a href="#" data-id="${data.id}" class="mr-1 size pro-size">${size}</a>
                        `);
                        }
                    });
                }else{
                    $('.product-size-swatch').attr('hidden',true);
                }

                //product color
                if (data.color !== ','){
                    $('.product-color-swatch').attr('hidden',false);
                    let productColors = data.color.split(',');
                    productColors.map(color => {
                        if (color !== ''){
                            $(productColor).append(`
                            <a href="#" class="mr-1 size pro-color">${color}</a>
                        `);
                        }
                    });
                }else{
                    $('.product-color-swatch').attr('hidden',true);
                }

                $(cartBtn).attr('data-id',data.id);
                init_carousel();

            },
            error: (error) => {console.log(error)}
        })
    });
});

$(function () {
    $(document).on('click','.pro-color',function (e) {
        e.preventDefault();
        $('.pro-color').css('border','');
        $(this).css('border','1px solid #2A9CF5');
        $('#productColor').val($(this).text());
    });

    $(document).on('click','.pro-size',function (e) {
        e.preventDefault();
        const id = $(this).attr('data-id');
        let sizeText = $(this).text();

        $('.pro-size').css('border','');
        $(this).css('border','1px solid #2A9CF5');
        $('#productSize').val(sizeText);
        $('.pvp').attr('hidden',false);
        $.ajax({
            type: 'GET',
            url: `/${id}/size-price`,
            data: {size: sizeText},
            success: (data) => {
                if (data != ''){
                    $('.pvp').attr('hidden',false);
                    $('.product-price-text-bottom').text(data);
                    $('#productPrice').val(data);
                    $('.product-price-text').text(data);
                }else{
                    $('.pvp').attr('hidden',true);
                }

            }
        })
    });

    $(document).on('click','.quantity-plus',function () {
        $('#productQty').val($(this).parent().find('.quantity').val());
    });

    $(document).on('click','.quantity-minus',function () {
        $('#productQty').val($(this).parent().find('.quantity').val());
    });

    $(document).on('keyup','.quantity',function () {
        $('#productQty').val($(this).val());
    });

    $(document).on('click','#btn-cart',function () {
        $('.mfp-close').click();
    });
});
