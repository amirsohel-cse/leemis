@extends('admin.layout.master.master')

@section('main-content')
    @if (Session::get('cache'))
        <div class="alert text-white container" style="background: #1dca0d;">
            {{ Session::get('cache') }}
        </div>
    @endif
    <!-- Page header section  -->
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h1><strong>Hi, Welcomeback!</strong></h1>
                <span>{{ Auth::user()->name }},</span>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order Pending</strong></div>
                            <h3 class="mb-1">{{ $data['order_pending'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order Processing</strong></div>
                            <h3 class="mb-1">{{ $data['order_processing'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order Completed</strong></div>
                            <h3 class="mb-1">{{ $data['order_completed'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order On Delivery</strong></div>
                            <h3 class="mb-1">{{ $data['order_onDelivery'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order Declined</strong></div>
                            <h3 class="mb-1">{{ $data['order_declined'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Total Order</strong></div>
                            <h3 class="mb-1">{{ $data['order_all'] }}</h3>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



    <div class="card">
        <div class="header">
            <h2><strong>Order City Statistics</strong></h2>
        </div>
        <div class="body">
            <div id="apex-basic-column"></div>
        </div>
    </div>

    <div class="row clearfix row-deck">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Recent Orders</strong></h2>
                </div>
                <div class="body">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th>Order Code</th>
                                <th>Order Date</th>
                                <th>Details</th>
                            </tr>
                            @foreach ($data['recent_orders'] as $row)
                                <tr>
                                    <td>{{ $row->order_id }}</td>
                                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                    <td><a href="{{ route('order.details', $row->id) }}"
                                            class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                            type="button"> view </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>





    </div>

    </div>

    <script src="{{ asset('../backend/js/pages/charts/chartjs.js') }}"></script>
    <script src="{{ asset('../backend/assets/bundles/chartist.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <script>
        $(".alert:not(.not_hide)").delay(6000).slideUp(500, function() {
            $(this).alert('close');
        });


        //Sales
        $(document).ready(function() {
            var options = {
                chart: {
                    type: 'line'
                },
                series: [{
                    name: 'Total Orders',
                    data: @json($totalOrder)
                }],
                xaxis: {
                    categories: @json($city)
                }
            }

            var chart = new ApexCharts(document.querySelector("#apex-basic-column"), options);

            chart.render();
        });
    </script>
@endsection
