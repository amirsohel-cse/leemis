@extends('admin.layout.master.master')


@section('main-content')
    <style>
        @media print {
            * {
                font-size: 12px;
                line-height: 20px;
            }

            td,
            th {
                padding: 5px 0;
            }

            .hidden-print {
                display: none !important;
            }

            @page {
                size: landscape;
                margin: 0 !important;
            }

            .barcodelist {
                max-width: 378px;
            }

            .barcodelist img {
                max-width: 150px;
            }
        }
    </style>
    <section class="forms" id="nonPrintable">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>Print Barcode</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic">
                                <small>{{ trans('The field labels marked with * are required input fields') }}.</small></p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{ trans('Add product') }} *</label>
                                            <div class="search-box input-group">

                                                <button type="button" class="btn btn-secondary btn-lg"><i
                                                        class="fa fa-barcode"></i></button>
                                                <input type="text" name="product_code_name" id="lims_productcodeSearch"
                                                    placeholder="Please type product code and select..."
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="table-responsive mt-3">
                                                <table id="myTable" class="table table-hover order-list">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ trans('name') }}</th>
                                                            <th>{{ trans('Code') }}</th>
                                                            <th>{{ trans('Quantity') }}</th>
                                                            <th><i class="dripicons-trash"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <strong>{{ trans('Print') }}: </strong>&nbsp;
                                        <strong><input type="checkbox" name="name" checked />
                                            {{ trans('Product Name') }}</strong>&nbsp;
                                        <strong><input type="checkbox" name="price" checked />
                                            {{ trans('Price') }}</strong>&nbsp;
                                        <!--<strong><input type="checkbox" name="promo_price"/> {{ trans('Promotional Price') }}</strong>-->
                                    </div>
                                    <!--<div class="row">-->
                                    <!--    <div class="col-md-4">-->
                                    <!--        <label><strong>Paper Size *</strong></label>-->
                                    <!--        <select class="form-control" name="paper_size" required id="paper-size">-->
                                    <!--            <option value="0">Select paper size...</option>-->
                                    <!--            <option value="36">36 mm (1.4 inch)</option>-->
                                    <!--            <option value="24">24 mm (0.94 inch)</option>-->
                                    <!--            <option value="18">18 mm (0.7 inch)</option>-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="form-group mt-3">
                                        <input type="submit" value="{{ trans('submit') }}" class="btn btn-primary"
                                            id="submit-button">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="print-barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_header" class="modal-title">Barcode</h5>&nbsp;&nbsp;
                    <button id="print-btn" type="button" class="btn btn-default btn-sm"><i class="dripicons-print"></i>
                        Print</button>
                    <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <div id="label-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
        $("ul#product").siblings('a').attr('aria-expanded', 'true');
        $("ul#product").addClass("show");
        $("ul#product #printBarcode-menu").addClass("active");


        var lims_productcodeSearch = $('#lims_productcodeSearch');

        lims_productcodeSearch.autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search') }}",
                    data: {
                        searchText: request.term,
                        maxResults: 10
                    },
                    dataType: "json",
                    success: function(data) {

                        response($.map(data, function(item) {
                            return {
                                label: item.code + ' ' + item.name,
                                image: item.photo_path
                            };
                        }))
                    }
                })
            },

            select: function(event, ui) {
                var data = ui.item.value;
                $.ajax({
                    type: 'GET',
                    url: 'lims_product_search',
                    data: {
                        data: data
                    },
                    success: function(data) {
                        console.log(data);
                        var flag = 1;
                        $(".product-code").each(function() {
                            if ($(this).text() == data[1]) {
                                alert('duplicate input is not allowed!')
                                flag = 0;
                            }
                        });
                        $("input[name='product_code_name']").val('');
                        if (flag) {
                            var newRow = $('<tr data-imagedata="' + data[2] + '" data-price="' +
                                data[1] + '" data-promo-price="' + data[4] +
                                '" data-currency="' + data[6] + '" data-sku="' + data[8] +
                                '" data-currency-position="' + data[7] + '">');
                            var cols = '';
                            cols += '<td>' + data[0] + '</td>';
                            cols += '<td class="product-code">' + data[5] + '</td>';
                            cols +=
                                '<td><input type="number" class="form-control qty" name="qty[]" value="1" /></td>';
                            cols +=
                                '<td><button type="button" class="ibtnDel btn btn-md btn-danger">Delete</button></td>';

                            newRow.append(cols);
                            $("table.order-list tbody").append(newRow);
                        }
                    }
                });
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            var inner_html = '<div class="list_item_container"><div class="image"><img src="' + item.image +
                '" width="50" height="50"></div><div class="label"></div><div class="description">' + item.label +
                '</div></div><hr/>';
            return $("<li></li>")
                .data("ui-autocomplete-item", item)
                .append(inner_html)
                .appendTo(ul);
        };

        //Delete product
        $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
            rowindex = $(this).closest('tr').index();
            $(this).closest("tr").remove();
        });

        $("#submit-button").on("click", function(event) {

            var product_name = [];
            var code = [];
            var price = [];
            var promo_price = [];
            var qty = [];
            var barcode_image = [];
            var currency = [];
            var currency_position = [];
            var sku = [];
            var rownumber = $('table.order-list tbody tr:last').index();
            var image = "{{ asset('storage/storeLogo/' . \App\Model\Logo::where('type', 'header')->first()->file) }}"
            for (i = 0; i <= rownumber; i++) {
                product_name.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(1)')
                    .text());
                code.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(2)').text());
                price.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('price'));
                promo_price.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('promo-price'));
                currency.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('currency'));
                currency_position.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data(
                    'currency-position'));
                qty.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val());
                barcode_image.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('imagedata'));
                sku.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('sku'));
            }
            var htmltext = '<table style="width:100% !important;text-align:center !important">';

            $.each(qty, function(index) {
                i = 0;
                while (i < qty[index]) {
                    // if(i % 2 == 0)
                    //     htmltext +='<tr>';

                    htmltext += `
                            <tr>
                            <td style="padding-top:25px !important;">
                                <div style="margin-left: -15px !important;font-size:12px">
                                    <img style="max-width:50px;max-hight:20px;margin-bottom:3px" src="${image}"/> <br> <img style="max-width:120px;margin-bottom:3px" src="data:image/png;base64,${barcode_image[index]}" alt="barcode" /><br> <span style="font-size:8px">SKU : ${sku[index]}</span><br>
                                </div>
                            </td>
                        </tr>
                        
                    
                    
                    `;

                    i++;
                }
            });
            htmltext += '</table>';

            $.ajax({
                url: "{{ route('product.print.barcode') }}",
                method: "GET",
                data: {
                    html: htmltext
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Barcode.pdf";
                    link.click();
                }
            })


            return;

            $('#label-content').html(htmltext);
            $('#print-barcode').modal('show');


        });



        $("#print-btn").on("click", function() {
            var divToPrint = document.getElementById('print-barcode');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write(
                '<style type="text/css">@media print { #modal_header { display: none } #print-btn { display: none } #close-btn { display: none } } table.barcodelist { page-break-inside:auto } table.barcodelist tr { page-break-inside:avoid; page-break-after:auto }</style><body onload="window.print()">' +
                divToPrint.innerHTML + '</body>');
            newWin.document.close();
            setTimeout(function() {
                newWin.close();
            }, 10);
        });
    </script>
@endpush
