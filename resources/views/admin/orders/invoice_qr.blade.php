<link rel="stylesheet" href="{{ asset('/backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<title>Hypershop.com.bd@Invoice</title>
<?php
$data = \App\Model\Favicon::first();
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
            <button onclick="window.print();" class="noPrint btn btn-primary">Print</button>
        </div>
    </div>
     <div class="row clearfix justify-content-center ">
        <div class="col-md-6">
            <div class="table-responsive bg-warning">
                <table class="table table-hover">
                    
                        <tr>
                            <td style="width:100%"><img src="\storage\storeLogo\{{ $invoiceLogo->file }}" height="80" width="140"></td>
                            <td class="text-center">
                                <h1>Thank You</h1>
                                <p>For Purchasing our product</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                <h4 class="font-weight-bold">BILL TO:</h4>
                                <p class="mb-0"> <span class="font-weight-bold">Name :</span>  {{ $order->order->name }}</p>
                                <p class="mb-0"><span class="font-weight-bold">Mobile:</span>  {{ $order->order->phone }}</p>
                                <p class="mb-0"><span class="font-weight-bold">Email :</span> {{ $order->order->email }}</p>
                                <p class="mb-0"><span class="font-weight-bold">Address :</span> {{ $order->order->address }}, {{ $order->order->city }}, {{ $order->order->zip }}</p>
                            </td>
                            <td class="text-center">
                                <p>
                                    
                                {!! QrCode::size(250)->generate(route('product.details', [$order->product->id, $order->product->slug])) !!}
                                </p>
                                <span class="font-weight-bold"><strong>Order Code :</strong> {{ $order->order->order_id }}</span><br>
                            </td>
                        </tr>
                       
                    </table>
                </div>
            </div>
        </div>
</div>
    
    
    
    
    
