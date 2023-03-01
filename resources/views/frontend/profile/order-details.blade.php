
@extends('frontend.master.master')
@section('content')
<head>
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.min.css')}}">

    </head>
</head>

<style>
    #oldPhoto{
        width: 100px;
        height: 100px;
    }

.table100.ver1 .table100-body tr:nth-child(even) {
  background-color: #f8f6ff;
}

/*---------------------------------------------*/


.table100.ver1 .ps__rail-y {
  right: 5px;
}

.table100.ver1 .ps__rail-y::before {
  background-color: #ebebeb;
}

.table100.ver1 .ps__rail-y .ps__thumb-y::before {
  background-color: #cccccc;
}

.limiter {
  width: 1366px;
  margin: 0 auto;
}

.container-table100 {
  width: 100%;
  min-height: 100vh;
  background: #fff;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  padding: 33px 30px;
}

.wrap-table100 {
  width: 1170px;
}

/*//////////////////////////////////////////////////////////////////
[ Table ]*/
.table100 {
  background-color: #fff;
}

table {
  width: 100%;
}

th, td {
  font-weight: unset;
  padding-right: 10px;
}

.column1 {
  width: 33%;
  padding-left: 40px;
}

.column2 {
  width: 13%;
}

.column3 {
  width: 22%;
}

.column4 {
  width: 19%;
}

.column5 {
  width: 13%;
}

.table100-head th {
  padding-top: 18px;
  padding-bottom: 18px;
}

.table100-body td {
  padding-top: 16px;
  padding-bottom: 16px;
}

/*==================================================================
[ Fix header ]*/
.table100 {
  position: relative;
  padding-top: 60px;
}

.table100-head {
  position: absolute;
  width: 100%;
  top: 0;
  left: 0;
}

</style>
<div class="page-content mb-10 pb-2">
    <div class="container">

        <div class="row mt-5">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="title mb-0"> Order Details </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive-sm">
                    <table class="table">
                        <tbody>
                            <tr>
                              <th class="border-0" width="45%">Order Id</th>
                              <th class="border-0" width="10%">:</th>
                              <td class="border-0" width="45%">#{{$orders->order->order_id}}</td>
                            </tr>
                            <tr>
                              <th width="45%">Total Product</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$orders->qty}}
                                @if($orders->attributes != null)
                                  @foreach ($orders->attributes as $attr)
                                    <p>{{\App\Model\CategoryAttribute::find($attr['attribute'])->name}} : {{\App\Model\AttributeOption::find($attr['option'])->option}}</p>
                                  @endforeach
                                  @else
                                @endif
                              </td>
                            </tr>
                            <tr>
                              <th width="45%">Total Cost</th>
                              <th width="10%">:</th>
                              <td width="45%">
                                <b>HK$ {{$orders->product->price}}</b>
                              </td>
                            </tr>
                            <tr>
                              <th width="45%">Ordered Date</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$orders->order->created_at->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                              <th width="45%">Payment Method</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$orders->order->payment_method}}</td>
                            </tr>
                            <tr>
                              <th width="45%">Order Status</th>
                              <th width="10%">:</th>
                              <td width="45%">
                                @if ($orders->order->status == 'pending')
                                  <span id="order-status" class="text-warning font-weight-bold">Pending</span>
                                @elseif($orders->order->status == 'Processing')
                                  <span id="order-status" class="text-info font-weight-bold">Processing</span>
                                @elseif($orders->order->status == 'Completed')
                                  <span id="order-status" class="text-success font-weight-bold">Completed</span>
                                  @elseif($orders->order->status == 'Declined')
                                  <span id="order-status" class="text-danger font-weight-bold">Declined</span>
                                  @elseif($orders->order->status == 'On Delivery')
                                  <span id="order-status" class="text-dark font-weight-bold">On Delivery</span>
                                @endif
                              </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="title mb-0"> Billing Details </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive-sm">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th width="45%">Name</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$orders->order->name}}</td>
                            </tr>
                            <tr>
                                <th width="45%">Email</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$orders->order->email}}</td>
                            </tr>
                            <tr>
                                <th width="45%">Phone</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$orders->order->phone}}</td>
                            </tr>
                            <tr>
                                <th width="45%">Address</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$orders->order->address}}</td>
                            </tr>

                            <tr>
                                <th width="45%">City</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$orders->order->city}}</td>
                            </tr>
                            <tr>
                                <th width="45%">Zip Code</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$orders->order->zip}}</td>
                            </tr>

                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="special-box">
                <div class=" table100 ver1 m-b-110">
                  <div style="width:100%;" class="table100-body mb-3">
                    <table class="table order-details-table bordered">
                      <tbody>
                        <tr class="row100 body">
                          <th class="cell100 column1">Product Image</th>
                          <th class="cell100 column1">Product Name</th>
                          <th class="cell100 column2">Vendor</th>
                          <th class="cell100 column3">Price</th>
                          <th class="cell100 column4">Shipping Method</th>
                          <th class="cell100 column5">Quantity</th>
                          <th class="cell100 column5">Order Status</th>
                        </tr>

                        <tr class="row100 body border-bottom">
                          <td style="padding:15px 20px" class="cell100 column1"><img width="100" src="{{url($orders->product->photo)}}"></td>

                          <td style="padding:15px 20px" class="cell100 column1">
                          <a class="text-dark" href={{ url('productdetails',$orders->product->id.'/'.$orders->product->slug) }}>{{$orders->product->getTranslation('name')}}</a></td>

                          <td style="padding:15px 20px" class="cell100 column2">@if(isset($orders->vendor->shop_name))<a href="{{route('shop.product',[$orders->vendor->id,Str::slug($orders->vendor->shop_name)])}}">{{$orders->vendor->shop_name}}</a>@endif</td>

                          <td style="padding:15px 20px" class="cell100 column3">HK$ {{$orders->product->price}}</td>

                          <td style="padding:15px 20px" class="cell100 column4 nowrap">{{$orders->order->shipping_method}}</td>

                          <td style="padding:15px 20px" class="cell100 column5">{{$orders->qty}}</td>

                          <td style="padding:15px 20px" class="cell100 column5">
                            @if ($orders->order->status == 'pending')
                              <span id="order-status" class="text-warning font-weight-bold">Pending</span>
                            @elseif($orders->order->status == 'Processing')
                              <span id="order-status" class="text-info font-weight-bold">Processing</span>
                            @elseif($orders->order->status == 'Completed')
                              <span id="order-status" class="text-success font-weight-bold">Completed</span>
                              @elseif($orders->order->status == 'Declined')
                              <span id="order-status" class="text-danger font-weight-bold">Declined</span>
                              @elseif($orders->order->status == 'On Delivery')
                              <span id="order-status" class="text-dark font-weight-bold">On Delivery</span>
                            @endif
                          </td>
                        </tr>
                        <tr class="order-table-bottom">
                          <td></td>
                          <td></td>
                          <td style="padding:15px 20px">Total Price</td>
                          <td style="padding:15px 20px"><strong>HK$ {{$orders->order->total}}</strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>
@endsection
