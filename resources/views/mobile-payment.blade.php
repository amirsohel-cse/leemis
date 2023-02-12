<!DOCTYPE html>
<html lang="en">
<head>
  <title>HYPER SHOP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  
  <meta name="csrf-token" content="{{csrf_token()}}">
  
</head>
<body>
    
    
@php
    
    Auth::loginUsingId($data['user_id']);
    
    session()->put('request1', $data);
    session()->put('type', 'mobile');
    
    

@endphp
<div class="container">
  <div class="row">
   <button type="submit" class="btn btn-success" id="bKash_button" onclick="BkashPayment()">
                                                    <img src="{{asset('bkash.png')}}" width="60"> Pay with bKash
                                                </button>
                                                
    <input type="hidden" id="t" value="{{$data['total']}}">
  </div>
</div>


 <script src=" https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script type="text/javascript">

            function BkashPayment() {
              
                $.ajax({
                    url: "{{ route('bkash-get-token') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    success: function (data) {
                        
                      
                        $('pay-with-bkash-button').trigger('click');
        
                        if (data.hasOwnProperty('msg')) {
                            showErrorMessage(data) // unknown error
                        }
                    },
                    error: function (err) {
        
                        showErrorMessage(err);
                    }
                });
            }
        
        
            let paymentID = '';
            bKash.init({
                paymentMode: 'checkout',
                paymentRequest: {

                },
                createRequest: function (request) {
                    setTimeout(function () {
                        createPayment(request);
                    }, 2000)
                },
        
                executeRequestOnAuthorization: function (request) {
                    $.ajax({
                        url: '{{ route('bkash-execute-payment') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: 'application/json',
                        data: JSON.stringify({
                            "paymentID": paymentID
                        }),
                        success: function (data) {
                            
                            
                            if (data) {
                                if (data.paymentID != null) {
                                    BkashSuccess(data);
                                } else {
                                    showErrorMessage(data);
                                    bKash.execute().onError();
                                }
                            } else {
                                $.get('{{ route('bkash-query-payment') }}', {
                                    payment_info: {
                                        payment_id: paymentID
                                    }
                                }, function (data) {
                                    
                                    if (data.transactionStatus === 'Completed') {
                                        BkashSuccess(data);
                                    } else {
                                        createPayment(request);
                                    }
                                });
                            }
                        },
                        error: function (err) {
                            bKash.execute().onError();
                        }
                    });
                },
                onClose: function () {
                    // for error handle after close bKash Popup
                }
            });
        
            function createPayment(request) {
                // Amount already checked and verified by the controller
                // because of createRequest function finds amount from this request
                request['amount'] = $('#t').val(); // max two decimal points allowed
        
                $.ajax({
                    url: '{{ route('bkash-create-payment') }}',
                    data: JSON.stringify(request),
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    success: function (data) {
      
                        if (data && data.paymentID != null) {
                            paymentID = data.paymentID;
                            bKash.create().onSuccess(data);
                        } else {
                            bKash.create().onError();
                        }
                    },
                    error: function (err) {
        
        
                        showErrorMessage(err.responseJSON);
                        bKash.create().onError();
                    }
                });
            }
        
            function BkashSuccess(data) {
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post('{{ route('bkash-success-mobile') }}', {
                    payment_info: data
                }, function (res) {
                        window.location.href = "{{route('orderComplete')}}" 
                });
            }
        
            function showErrorMessage(response) {
                let message = 'Unknown Error';
        
                if (response.hasOwnProperty('errorMessage')) {
                    let errorCode = parseInt(response.errorCode);
                    let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                        2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                        2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                        2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                        2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
                    ];
        
                    if (bkashErrorCode.includes(errorCode)) {
                        message = response.errorMessage
                        
                        
                        swal(message, "warning");
                    }
                }
                
                swal(message, "warning");
        
               
            }
        </script>




    <script>
        //$("#place-orderBtn").attr("disabled","disabled");


        $(function() {
            $('.delete_btn').on('click', function() {
                const modal = $('#deleteMyPlace');

                modal.find('form').attr('action', $(this).data('url'));


                modal.modal('show');
            })
        })




        $("input:radio").first().click();

        $("input:radio:first").prop("checked:true", function() {
            var amount = parseInt($(this).val()) + parseInt($("#subtotal").val());
            $("#total").text(amount);
            $("#t").val(amount);


        });

        $('.ship').on("change", function() {
            var amount = parseInt($(this).val()) + parseInt($("#subtotal").val());
            $("#total").text(amount);
            $("#t").val(amount);

        });

        $('#place-orderBtn').on('click', function(e) {
            $('#checkout-form').attr('action', "{{ url('/ordercompelete') }}");

        })


        $('#onlinePayChackBox').on('change', function(e) {
            if ($(this).prop('checked') == true) {
                $('#phonenum').attr('hidden', true);
                $('#tranid').attr('hidden', true);
                $('#place-orderBtn').attr('hidden', true);
                $('#bKash_button').attr('hidden', false);
            }
        });

        $('#cashOnCheckBox').on('change', function() {
            if ($(this).prop('checked') == true) {
                $('#place-orderBtn').attr('hidden', false);
                $('#phonenum').attr('hidden', false);
                $('#tranid').attr('hidden', false);
                $('#bKash_button').attr('hidden', true);
            }
        })


        $(document).on('submit', '#checkout-form', function(e) {
            e.preventDefault()
            let phone = $('#phone').val();
            let regex = new RegExp(/^(?:\+88|88)?(01[3-9]\d{8})$/);
            if (phone) {
                if (regex.test(phone)) {
                    $('#phoneError').text('');
                } else {
                    e.preventDefault();
                    $('#phoneError').text('Your phone number is invalid!!');
                }
            }

            if (!navigator.onLine) {
                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['error']('You are in Offline!!!');
                e.preventDefault();
            }
        })
    </script>

</body>
</html>
