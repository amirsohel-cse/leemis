@extends('admin.layout.master.master')
@section('main-content')
    <div class="block-header d-flex justify-content-between">
        <div class="row clearfix w-75">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1>Order Details</h1>
                <a href="/admin/dashboard"><span>Dashboard</span></a> <i class="fa fa-angle-right"></i>
                <a href="/admin/orders/view"><span>All Orders</span> </a> <i class="fa fa-angle-right"></i>
                <span>Order Details</span>
            </div>
        </div>
        <!-- to update status -->
        <select name="" class="theme-bg" data-id="{{ $orders[0]->order->id }}" id="selectStatus">
            <option class="text-light" value="Pending" {{ $orders[0]->order->status == 'Pending' ? 'selected' : '' }}>
                Pending</option>
            <option class="text-light" value="Processing"
                {{ $orders[0]->order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
            <option class="text-light" value="On Delivery"
                {{ $orders[0]->order->status == 'On Delivery' ? 'selected' : '' }}>On Delivery</option>
            <option class="text-light" value="Completed"
                {{ $orders[0]->order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option class="text-light" value="Declined"
                {{ $orders[0]->order->status == 'Declined' ? 'selected' : '' }}>
                Declined</option>
        </select>
        <!-- --------------- -->
    </div>

    <div class="content-area">
        <div class="order-table-wrap">

            <div class="row">
                <div class="col-lg-6">
                    <div class="special-box">
                        <div class="heading-area">
                            <h4 class="title">
                                Order Details
                            </h4>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="45%" width="45%">Order ID</th>
                                        <td width="10%">:</td>
                                        <td class="45%" width="45%">
                                            {{ isset($orders[0]->order->order_id) ? $orders[0]->order->order_id : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="45%">Total Product</th>
                                        <td width="10%">:</td>
                                        <td width="45%">
                                            {{ $orders[0]->where('order_id', $orders[0]->order_id)->sum('qty') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="45%">Total Cost</th>
                                        <td width="10%">:</td>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->total) ? $orders[0]->order->total : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">Ordered Date</th>
                                        <td width="10%">:</td>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->created_at) ? $orders[0]->order->created_at->format('y-m-d') : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="45%">Payment Method</th>
                                        <td width="10%">:</td>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->payment_method) ? $orders[0]->order->payment_method : '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="45%">Order Status</th>
                                        <th width="10%">:</th>
                                        <td width="45%"><span id="order-status"
                                                class='badge badge-danger'>{{ isset($orders[0]->order->status) ? $orders[0]->order->status : '' }}</span>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="footer-area">
                            <a href="{{ route('order.invoice', $orders[0]->order->id) }}" class="mybtn1"><i
                                    class="fa fa-eye"></i> View Invoice</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="special-box">
                        <div class="heading-area">
                            <h4 class="title">
                                Billing Details
                            </h4>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th width="45%">Name</th>
                                        <th width="10%">:</th>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->name) ? $orders[0]->order->name : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="45%">Email</th>
                                        <th width="10%">:</th>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->email) ? $orders[0]->order->email : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">Phone</th>
                                        <th width="10%">:</th>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->phone) ? $orders[0]->order->phone : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">Address</th>
                                        <th width="10%">:</th>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->address) ? $orders[0]->order->address : '' }}
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                            <th width="45%">City</th>
                                            <th width="10%">:</th>
                                            <td width="45%">Bangladesh</td>
                                        </tr> -->
                                    <tr>
                                        <th width="45%">City</th>
                                        <th width="10%">:</th>
                                        <td width="45%">
                                            {{ isset($orders[0]->order->city) ? $orders[0]->order->city : '' }}
                                        </td>
                                    </tr>
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="mr-table">
                        <h4 class="title">Products Ordered</h4>
                        <div class="">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th width="10%">Product ID#</th>
                                        <th>Shop Name</th>
                                        <th>Vendor Status</th>
                                        <th>Product Title</th>
                                        <th width="20%">Details</th>
                                        <th width="20%">Varient Price</th>
                                        <th width="10%">Total Price</th>
                                        <th width="10%">Commission</th>
                                        <th width="10%">Profit</th>

                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                        <tr>
                                            <td>{{ $item->product_id }}</td>
                                            <td>
                                                <a target="_blank"
                                                    href="{{ route('shop.product', [$item->product->vendor->id, Str::slug($item->product->vendor->shop_name)]) }}">{{ isset($item->product->vendor->shop_name) ? $item->product->vendor->shop_name : '' }}</a>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-danger">{{ isset($item->vendor_status) ? $item->vendor_status : '' }}</span>
                                            </td>
                                            <td>
                                                <a target="_blank"
                                                    href="{{ isset($item->product->id) ? url('productdetails/' . $item->product->id . '/' . $item->product->slug) : '#' }}">{{ @$item->product->name }}</a>
                                            </td>
                                            <td>
                                                @if ($item->attributes != null)
                                                    @foreach ($item->attributes as $attr)
                                                        <p>{{ \App\Model\CategoryAttribute::find($attr['attribute'])->name }}
                                                            :
                                                            {{ \App\Model\AttributeOption::find($attr['option'])->option }}
                                                        </p>
                                                    @endforeach
                                                @else
                                                @endif
                                                <p>
                                                    <strong>Price :</strong>
                                                    {{ isset($item->product->price) ? $item->product->price : '' }}
                                                </p>
                                                <p>
                                                    <strong>Qty :</strong> {{ $item->qty }}
                                                </p>
                                            </td>

                                            <td>
                                                {{$item->additional_price * $item->qty }}
                                            </td>

                                            <td>
                                                {{ isset($item->product->price) ? $item->qty * ($item->product->price + $item->additional_price) : '' }}
                                            </td>
                                            <td>
                                                {{ isset($item->product->categories->commision) ? $item->product->categories->commision : '' }}
                                                %
                                            </td>
                                            <td>
                                                {{ isset($item->product->categories->commision) ? $item->qty * ($item->product->price + $item->additional_price) * ($item->product->categories->commision / 100) : '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('page-stylesheet')
        <link rel="stylesheet" href="{{ asset('/backend/assets/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('/backend/assets/css/custom.css') }}">
    @endsection
    @section('page-scripts')
        <script src="{{ asset('/backend/assets/js/jquery.nice-select.js') }}"></script>
        <script !src="">
            // $(document).ready(function () {
            //     $('select').niceSelect();
            // });

            //Status update ajax
            $(document).ready(function() {
                $(document).on('change', '#selectStatus', function() {
                    let status = $(this).val();
                    let id = $(this).attr('data-id');
                    $.ajax({
                        type: 'GET',
                        url: `/admin/orders/${id}/updateOrderStatus`,
                        data: {
                            status: status
                        },
                        success: (data) => {
                            toastr.options = {
                                "timeOut": "2000",
                                "closeButton": true,
                            };
                            toastr['success'](data);
                            $('#order-status').text(status);
                        },
                        error: (error) => {
                            console.log(error);
                        }
                    })
                });
            });
        </script>
    @endsection
