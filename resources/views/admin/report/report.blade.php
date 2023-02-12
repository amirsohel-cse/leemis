@extends('admin.layout.master.master')
@section('main-content')

    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    </head>

    <div class="d-flex flex-row-reverse bd-highlight">
        <div class="btn-group">
            <button class="btn btn-primary todaybtn" data-date="today">Today</button>
            <button class="btn btn-primary lastsevenbtn" data-date="week">Last 7 Days</button>
            <button class="btn btn-primary monthbtn" data-date="month">Last Month</button>
            <button class="btn btn-primary date" data-date="year">Last Year</button>
        </div>
    </div>



<div id="append">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card overflowhidden">
                <div class="body">
                    <h3>{{ $product_sold }}<i class="fa fa-shopping-basket float-right"></i></h3>
                    <span>Products Sold</span>
                </div>
                <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                    <div class="progress-bar" data-transitiongoal="64"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card overflowhidden">
                <div class="body">
                    <h3>{{ $total_profit }}<i class="fa fa-dollar float-right"></i></h3>
                    <span>Total Profit</span>
                </div>
                <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                    <div class="progress-bar" data-transitiongoal="64"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card overflowhidden">
                <div class="body">
                    <h3>{{ $total_sell }}<i class="fa fa-dollar float-right"></i></h3>
                    <span>Total Selling Amount</span>
                </div>
                <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                    <div class="progress-bar" data-transitiongoal="64"></div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-12">
            <div id="todayr" class="table mt-3">
                <table id="r"class="table table-striped table-hover dataTable js-exportable">
        
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Date</th>
                            <th>Biller Name</th>
                            <th>Biller Phone</th>
                            <th>Products</th>
                            <th>Payment Method</th>
                            <th>Shipping Method</th>
                            <th>Total</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        @foreach ($all_oders as $row)
                            <tr>
                                <td>{{ $row->order_id }}</td>
                                <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->orderProduct->sum('qty') }}</td>
                                <td>{{ $row->payment_method }}</td>
                                <td>{{ $row->shipping_method }}</td>
                                <td>{{ $row->subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




    <script>
        $('.todaybtn, .lastsevenbtn, .monthbtn, .date').on('click', function() {
            let date = $(this).data('date');

            $.ajax({
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    date: date
                },
                success: function(response) {
                    
                   $('#append').html(response)
                }
            })


        })

    </script>
@endsection
