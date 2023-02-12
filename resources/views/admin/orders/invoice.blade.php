<link rel="stylesheet" href="{{ asset('/backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<title>Hypershop.com.bd@Invoice</title>
<?php
$data = \App\Model\Favicon::first();

$footer = \App\Model\Footer::first()
?>
@if ($data)
    <link rel="icon" type="image/png" href="{{ asset('storage/storeFavicon/' . $data->file) }}">
@else
    <link rel="icon" type="image/png" href="{{ asset('storage/storeFavicon/common.png') }}">
@endif
<style>
    @media print {
        .noPrint {
            display: none;
        }
    }
    strong {
        font-weight: 500;
    }

</style>
<div class="mt-5 container mb-5">
    <div class="row clearfix mb-5">
        <div class="col-lg-6">
            <a class=" mb-3 btn noPrint btn-success" href="/admin/orders/view">Back to Order</a>
        </div>
        <div class="col-md-6 text-right">
            <button onclick="window.print();" class="noPrint btn btn-primary">Print Invoice</button>
        </div>
    </div>
    <div class="row clearfix mb-2">
        <div class="col-lg-6 col-sm-6">
            <b>BILL FROM:</b>
            <p class="mb-0">HyperShop</p>
            <p class="mb-0"><b>Address:</b>{{strip_tags($footer->copyright)}}</p>
            <p class="mb-0"><b>Phone:</b> {{$footer->site_number}}</p>
            <p class="mb-0"><b>Website:</b> https://www.hypershop.com.bd</p>
        </div>
        <div class="col-lg-6 col-sm-6 text-right">
            <img src="\storage\storeLogo\{{ $invoiceLogo[0]->file }}" height="80" width="140">
        </div>
    </div>
    <hr class="my-4" />
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-6">
            <b>BILL TO:</b>
            <p class="mb-0"><b>Name:</b> {{ $orders[0]->order->name }}</p>
            <p class="mb-0"><b>Phone:</b> {{ $orders[0]->order->phone }}</p>
            <p class="mb-0"><b>Mail:</b> {{ $orders[0]->order->email }}</p>
            <p class="mb-0"><b>Address:</b> {{ $orders[0]->order->address }}, {{ $orders[0]->order->city }}, {{ $orders[0]->order->zip }}</p>
        </div>

        <div class="col-md-6 col-sm-6 text-right">
            <div class="d-inline-block">
                <h4 class="font-weight-normal">INVOICE </h4>
                <span><strong>Order Date :</strong> {{ $orders[0]->order->created_at->format('d-m-Y') }}</span><br>
                <span><strong>Order Code :</strong> {{ $orders[0]->order->order_id }}</span><br>
                <span> <strong>Shipping Method :</strong>
                    {{ $orders[0]->order->shipping_method }}
                </span><br>
                <span> <strong>Payment Method :</strong> {{ $orders[0]->order->payment_method }}</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Item</th>
                            <th style="width: 120px;">Quantity(Pcs)</th>
                            <th class="hidden-sm-down" style="width: 80px;">Price(TK)</th>
                            <th class="hidden-sm-down" style="width: 80px;">Varient Price(TK)</th>
                            <th style="width: 80px; text-align: right">Total(TK)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                            <tr>
                                <td>{{ $orders[0]->order->order_id }}</td>
                                <td>
                                    <span>{{ $item->product->name }}</span><br>
                                    <small>Color: {{ $orders[0]->color }}</small><small> Size:
                                        {{ $orders[0]->size }}</small>
                                    <p class="hidden-sm-down mb-0 text-muted">Shop Name :{{ $item->vendor->shop_name }}
                                    </p>
                                </td>
                                <td>{{ $item->qty }}</td>
                                <td class="hidden-sm-down">{{ $item->product->price }}</td>
                                <td class="hidden-sm-down">{{ $item->additional_price }}</td>
                                <td class="text-right">
                                    {{ $item->qty * ($item->product->price + $item->additional_price) }}
                                </td>
                            </tr>
                        @empty
                            <td colspan="6" class="text-center">No data Available</td>
                        @endforelse
                        <!--<tr>-->
                        <!--    <td colspan="4"></td>-->
                        <!--    <td class="text-right" colspan="2">-->
                        <!--        <span>Subtotal: <strong-->
                        <!--                class="text-success">{{ $orders[0]->order->subtotal }}</strong></span>-->
                        <!--    </td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--    <td colspan="4"></td>-->
                        <!--    <td class="text-right" colspan="2">-->
                        <!--        <span>Shipping Cost: <strong class="text-success">{{ $orders[0]->order->shipping_method }}</strong></span>-->
                        <!--    </td>-->
                        <!--</tr>-->
                    </tbody>

                    <!--<tfoot>-->
                    <!--    <td colspan="4"></td>-->
                    <!--    <td class="text-right" colspan="2">-->
                    <!--        <span>Total: <strong class="text-success">{{ $orders[0]->order->total }}</strong></span>-->
                    <!--    </td>-->
                    <!--</tfoot>-->
                </table>
                <div class="row clearfix m-0">
                    <div class="col-lg-8 col-md-8"></div>
                    <div class="col-lg-4 col-md-4">
                        <div class="row clearfix mb-2">
                            <span class="col-lg-5 col-md-5 text-muted">Subtotal</span>
                            <span class="col-lg-7 col-md-7 text-right"><strong>{{ $orders[0]->order->subtotal }}</strong></span>
                        </div>
                        <div class="row clearfix mb-2">
                            <span class="col-lg-5 col-md-5 text-muted">Shipping Cost</span>
                            <span class="col-lg-7 col-md-7 text-right"><strong>{{ $orders[0]->order->shipping_method }}</strong></span>
                        </div>
                        <div class="row clearfix">
                            <span class="col-lg-5 col-md-5 text-muted">Total</span>
                            <span class="col-lg-7 col-md-7 text-right"><h5>{{ $orders[0]->order->total }}</h5></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5 text-center">
                        <span><strong>Note:</strong> Thank you for doing Business with us.</span>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
