<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypershop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('frontend/assets/vendor/fontawesome-free/css/all.min.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/css/line-awesome.min.css')); ?>">
    <link rel="stylesheet" href="https://hyper.springsoftit.com/frontend/assets/scss/demos/demo5/demo5.css" />

    <style>
        .faq-banner {
            padding-top: 60px;
            padding-bottom: 130px;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .faq-banner-title {
            font-size: 48px;
            text-align: center;
            color: #404553;
        }

        .faq-form {
            position: relative;
        }

        .faq-form input {
            height: 60px;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid transparent;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            padding-left: 50px;
            width: 100%;
            transition: all 0.3s;
        }

        .faq-form input:focus {
            border-color: #1914fe;
        }

        .faq-form i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%) rotate(-90deg);
            font-size: 24px;
            color: #000;
        }

        .section-padding {
            padding: 80px 0;
        }

        .faq-box {
            display: flex;
            flex-wrap: wrap;
            padding: 40px;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 2px 3px 0 rgb(0 0 0 / 4%);
            border: solid 1px rgba(244, 244, 244, 1);
            transition: all 0.3s;
            position: relative;
        }

        .faq-box:hover {
            box-shadow: 0 2px 3px 0 #0000001a;
        }

        .faq-box-link {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .faq-box .icon {
            width: 60px;
        }

        .faq-box .icon img {
            width: 60px;
        }

        .faq-box .content {
            width: calc(100% - 60px);
            padding-left: 30px;
        }

        .faq-box .content .title {
            font-size: 24px;
            color: #404553;
        }

        .faq-box .content p {
            font-size: 15px;
        }

        @media (min-width: 1200px) {
            .custom-container {
                max-width: 1040px;
            }
        }

        .mb-none-30 {
            margin-bottom: -30px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .faq-footer {
            padding: 30px 0;
            background-color: #f3f3f3;
            border-top: 1px solid #e5e5e5;
        }

        .faq-header {
            padding: 15px 0;
            background-color: #FEEE00;
        }

        .faq-logo img {
            max-width: 175px;
            max-height: 55px;
        }

        .faq-header .back-text {
            color: #404553;
        }

        @media (max-width: 991px) {
            .faq-banner-title {
                font-size: 42px;
            }
        }

        @media (max-width: 575px) {
            .faq-banner-title {
                font-size: 36px;
            }
        }

        @media (max-width: 480px) {
            .faq-banner-title {
                font-size: 32px;
            }

            .faq-box {
                padding: 20px;
            }

            .faq-box .content {
                width: 100%;
                padding-left: 0;
                margin-top: 20px;
            }

            .faq-box .content .title {
                font-size: 20px;
            }
        }


        title {
            width: 100%;
            margin: 3em 0 1em;
            text-align: center;
            font-family: "Arvo", "Helvetica Neue", Helvetica, arial, sans-serif;
            font-size: 170%;
            font-weight: 400;
            color: #fff;
        }

        .subtitle {
            width: 100%;
            margin: 0em 0 1em;
            text-align: center;
            font-family: "Arvo", "Helvetica Neue", Helvetica, arial, sans-serif;
            font-size: 95%;
            font-weight: 400;
            color: #fff;
        }

        .search-field {
            display: block;
            width: 30%;
            margin: 1em auto 0;
            padding: 0.5em 10px;
            border: 1px solid #999;
            font-size: 130%;
            font-family: "Arvo", "Helvetica Neue", Helvetica, arial, sans-serif;
            font-weight: 400;
            color: #3e8ce0;
        }

        .term-list {
            list-style: none inside;
            width: 30%;
            margin: 0 auto 2em;
            padding: 5px 10px 0;
            text-align: left;
            color: #777;
            background: #fff;
            border: 1px solid;
            font-family: "Arvo", "Helvetica Neue", Helvetica, arial, sans-serif;
            font-weight: 400;
        }

        .term-list li {
            padding: 0.5em 0;
            border-bottom: 1px solid #eee;
        }

        .term-list strong {
            color: #444;
            font-weight: 700;
        }

        .hidden {
            display: none;
        }

        .faq-banner-area {
            position: relative;
        }

        #search:focus {
            border-color: transparent !important;
        }

        #search.active {
            border-radius: 8px 8px 0 0;
        }
        
        #appear {
            position: absolute;
            top: 100%;
            left: 0;
            padding: 50px 0 20px 0;
            background-color: #fff;
            list-style: none;
            border-radius: 6px;
            width: 100%;
            box-shadow: 0 15px 20px rgba(0,0,0, 0.1);
            transform: scaleX(0);
            transform-origin: top;
            transition: all 0.5s;
        }

        #appear.active {
            border-radius: 0 0 8px 8px;
            border-top: 1px solid #e5e5e5;
            transform: scaleX(1);
        }
        
        #appear::after {
            position: absolute;
            content: "Top article suggestions";
            top: 10px;
            left: 20px;
            color: #ccc;
        }
        #appear::before {
            position: absolute;
            content: '';
            top: 40px;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #ddd;
        }
        li.list-items a {
            font-size: 13px;
            padding: 5px 20px;
            color: #777;
            display: block;
        }
        li.list-items:hover a {
            background-color: #f7f7f7;
            text-decoration: none;
        }
        
        @media (max-width: 575px) {
            #appear {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <?php
    $headerLogo = \App\Model\Logo::where('type', 'header')->first();
    ?>

    <header class="faq-header">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <a href="/" class="faq-logo">
                        <img src="\storage\storeLogo\<?php echo e($headerLogo->file); ?>" alt="image">
                    </a>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="<?php echo e(route('home')); ?>" class="back-text">Back to Hypershop</a>
                </div>
            </div>
        </div>
    </header>

    <section class="faq-banner"
        style="background-image: url('https://theme.zdassets.com/theme_assets/1061178/469d041ea674c50c3bfc90582ca36ead6884e485.svg')">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2 class="faq-banner-title">Hello! How can we help?</h2>
                    <div class="faq-banner-area">
                        <form class="faq-form mt-4">
                            <input type="text" name="#0" placeholder="Search the help here" id="search">
                            <i class="las la-search"></i>
                        </form>

                        <ul class="list-group" id="appear">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php echo $__env->yieldContent('content'); ?>



    <footer class="faq-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="mb-0">copyright@hypershop.com.bd .developed by spring soft it</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?php echo e(asset('../frontend/assets/vendor/jquery/jquery.min.js')); ?>"></script>
    

    <script>
        $(function() {
            $('#search').on('keyup', function(){
                $(this).addClass('active');
                
                $('#appear').addClass('active');

                $.ajax({
                    url: "<?php echo e(route('help.ajax')); ?>",
                    method: "GET",
                    data: {
                        search: $(this).val()
                    },
                    success: function(response) {
                     $('#appear').html(response)   
                    }
                })
            });

             //close when click off of container
            $(document).on('click touchstart', function (e){
                if (!$(e.target).is('.faq-banner-area, .faq-banner-area *, .list-group, .list-group *')) {
                    $('#appear').removeClass('active');
                    $('#search').removeClass('active');
                }
            });

        });
    </script>

    <?php echo $__env->yieldPushContent('script'); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/frontend/master/help_master.blade.php ENDPATH**/ ?>