@extends('frontend.master.master')
@section('content')
<head>
    <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
    <style>
:root {
  --border-color: #D7DBE3;
  font-family: -apple-system, BlinkMacSystemFont, 'Roboto', 'Open Sans', 'Helvetica Neue', sans-serif;
  --green: #0CD977;
  --red: #FF1C1C;
  --pink: #FF93DE;
  --purple: #5767ED;
  --yellow: #FFC61C;
  --rotation: 0deg;
  }
.wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50vh;
  
}

/*.modal {*/
/*  width: 300px;*/
/*  margin: 0 auto;*/
/*  border: 1px solid var(--border-color);*/
/*  box-shadow: 0px 0px 5px rgba(0,0,0,0.16);*/
/*  background-color: #fff;*/
/*  border-radius: 0.25rem;*/
/*  padding: 2rem;*/
/*  z-index: 1;*/
/*}*/

.emoji {
  display: block;
  text-align: center;
  font-size: 7rem;
  line-height: 5rem;
  transform: scale(0.5);
  animation: scaleCup 2s infinite alternate;
  // padding: 10px;
  // width: 100px;
  // height: 100px;
}
// .round {
//   border-radius: 100px;
//   border: 1px solid #000;
// }

@keyframes scaleCup {
  0% {
    transform: scale(0.6);
  } 
  
  100% {
    transform: scale(1);
  }
}

h1 {
  text-align: center;
  font-size: 1em;
  margin-top: 20px;
  margin-bottom: 20px;
}


.modal-btn {
  display: block;
  margin: 0 -2rem -2rem -2rem;
  padding: 1rem 2rem;
  font-size: .75rem;
  text-transform: uppercase;
  text-align: center;
  color: #fff;
  font-weight: 600;
  border-radius: 0 0 .25rem .25rem;
  background-color: var(--green);
  text-decoration: none;
}

@keyframes confettiRain {
  0% {
    opacity: 1;
    margin-top: -100vh;
    margin-left: -200px;
  } 
  
  100% {
    opacity: 1;
    margin-top: 100vh;
    margin-left: 200px;
  }
}

.confetti {
  opacity: 0;
  position: absolute;
  width: 1rem;
  height: 1.5rem;
  transition: 500ms ease;
  animation: confettiRain 5s infinite;
}

#confetti-wrapper {
   overflow: hidden !important;
}

    </style>

</head>

        <!-- Start of Main -->
        <main class="main order">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                       
                        <li class="active"><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content mb-10 pb-2">
                <div class="container">
                <div>
  <div class="shadow p-5 col-md-5 ml-auto mr-auto">
 <span class="emoji"><i style="color:#16C60C" class="fas fa-check-circle"></i></span> 
    <!-- <span class="emoji round">🏆✅</span> -->
    <h1>Thank You, Your Order has been received</h1>
    
  </div>
  <div id="confetti-wrapper">
  </div>
</div>
                    <!-- End of Order Success -->
                   
                    <ul class="order-view list-style-none">
                        <li class="shadow">
                            <label>Order code</label>
                            <strong>{{$orders[0]->order->order_id}}</strong>
                        </li>
                        <li class="shadow">
                            <label>Status</label>
                            <strong>{{$orders[0]->order->status}}</strong>
                        </li>
                        <li class="shadow">
                            <label>Date</label>
                            <strong>{{$orders[0]->order->created_at->format('d-m-Y')}}</strong>
                        </li>
                        <li class="shadow">
                            <label>Total</label>
                            <strong>{{$orders[0]->order->total}}</strong>
                        </li>
                           <li class="shadow">
                            <label>Shipping</label>
                            <strong>{{$orders[0]->order->shipping_method}}</strong>
                        </li>
                        <li class="shadow">
                            <label>Payment method</label>
                            <strong>{{($orders[0]->order->payment_method == 'cash on') ? "Cash On Delivery" : "Paid"}}</strong>
                        </li>
                    </ul>
                    <!-- End of Order View -->

                    <!-- <div style="display:flex; flex-direction:row" class="justify-content-around">
                        <div class="order-details-wrapper mb-5">
                            <h4 class="title text-uppercase ls-25 mb-5">Order Details</h4>
                            <table style="width:400px;padding:50px" class="order-table">
                                <thead>
                                    <tr>
                                        <th class="text-dark p-3">Product</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                    <tr>
                                        <td class="p-3">
                                            <a href="#">{{$item->product->name}}</a>&nbsp;<strong>x {{$item->qty}}</strong><br>
                                            <small>color: {{$orders[0]->color}}</small> <br>
                                            <span><small>Size: {{$orders[0]->size}}</small></span><br>
                                            {{-- Shop Name : <a href="#">{{$item->vendor?$item->vendor->shop_name:null}}</a> --}}
                                        </td>
                                        <td class="p-3">{{$item->qty* $item->product->price}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="p-3">Subtotal:</th>
                                        <td class="p-3">{{$orders[0]->order->subtotal}}</td>
                                    </tr>
                                    <tr>
                                        <th class="p-3">Shipping:</th>
                                        <td class="p-3">{{$orders[0]->order->shipping_method}}</td>
                                    </tr>
                                    <tr>
                                        <th class="p-3">Payment method:</th>
                                        <td class="p-3">{{$orders[0]->order->payment_method}}</td>
                                    </tr>
                                    <tr class="total bg-success">
                                        <th class="border-no p-3 text-white">Total:</th>
                                        <td class="border-no p-3 text-white">{{$orders[0]->order->total}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                      
                        <div id="account-addresses" class="">
                            
                                <div class="col-sm-6 mb-8 ">
                                    <div class="ecommerce-address billing-address">
                                        <h3 style="font-size:20px;padding-bottom: -0.6rem !important" class=" text-uppercase ls-25 mb-5">shipping Details</h3>
                                        
                                            <table style="width: 400px;" class="border address-table">
                                                <tbody>
                                                    <tr class="p-2">
                                                        <th class="p-3">Name</th>
                                                        <td >{{$orders[0]->order->name}}</td>
                                                    </tr>
                                                    <tr class="p-2">
                                                        <th class="p-3">Address</th>
                                                        <td >{{$orders[0]->order->address}}</td>
                                                    </tr>
                                                    <tr class="p-2">
                                                        <th class="p-3">City</th>
                                                        <td >{{$orders[0]->order->city}}</td>
                                                    </tr>
                                                    <tr class="p-2">
                                                        <th class="p-3">Zip</th>
                                                        <td >{{$orders[0]->order->zip}}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td >{{$orders[0]->order->country}}</td>
                                                    </tr> --}}
                                                   
                                                    <tr class="p-2">
                                                        <th class="p-3">Contact Number</th>
                                                        <td>{{$orders[0]->order->phone}}</td>
                                                    </tr>
                                                    <tr class="email p-3">
                                                        <th class="p-3">E-mail</th>
                                                        <td>{{$orders[0]->order->email}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                       
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 mb-8">
                                    <div class="ecommerce-address shipping-address">
                                        <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                    <tr>
                                                        <td>John Doe</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Conia</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wall Street</td>
                                                    </tr>
                                                    <tr>
                                                        <td>California</td>
                                                    </tr>
                                                    <tr>
                                                        <td>United States (US)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>92020</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                    </div>
                                </div> --}}
                           
                        </div>
                    </div> -->

                <div class="row">
            <div class="col-lg-12">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                        Order Id : #{{$orders[0]->order->order_id}}
                        </h4>
                    </div>
                <div class=" table100 ver1 m-b-110">
					<div style="width:100%;overflow-x:auto" class="table100-body mb-3">
						<table  class="table table-hover table-bordered">
							<tbody>
								<tr class="row100 body">
									<th class="cell100 column1">Product Name</th>
                                    <th class="cell100 column1">Product Image</th>
									<th class="cell100 column2">Vendor</th>
									<th class="cell100 column3">Price</th>
									<th class="cell100 column5">Varient</th>
									<th class="cell100 column5">Varient Price</th>
									<th class="cell100 column4">Payment Method</th>
									<th class="cell100 column5">Qantity</th>
									<th class="cell100 column5">Order Status</th>
									<th class="cell100 column5">Order Date</th>
								</tr>
								 @foreach ($orders as $orders)

								<tr class="row100 body border-bottom">

									<td style="padding:22px" class="cell100 column1"><a href={{ url('productdetails',$orders->product->id.'/'.$orders->product->slug) }}>{{$orders->product->name}}</a></td>
                                    <td style="padding:22px" class="cell100 column1"><img width="100" src="{{$orders->product->photo}}"</td>
                                    <td style="padding:22px" class="cell100 column2">@if(isset($orders->product->vendor->shop_name))<a href="{{route('shop.product',[$orders->product->vendor->id,Str::slug($orders->product->vendor->shop_name)])}}">{{$orders->product->vendor->shop_name}}</a>@endif</td>
									<td style="padding:22px" class="cell100 column3">{{$orders->product->price}}</td>
                                    <td style="padding:22px" class="cell100 column5">
                                        @if($orders->attributes != null)
                                                @foreach ($orders->attributes as $attr)
                                                    <p>{{\App\Model\CategoryAttribute::find($attr['attribute'])->name}} : {{\App\Model\AttributeOption::find($attr['option'])->option}}</p>
                                                        
                                                @endforeach

                                           @else

                                            

                                           @endif
                                    </td>
                                    <td class="cell100 column4">
                                        {{$orders->additional_price * $orders->qty}}
                                    </td>
									 
									<td style="padding:22px" class="cell100 column4">{{$orders->order->payment_method}}</td>
									<td style="padding:22px" class="cell100 column5">{{$orders->qty}}</td>
									
									
									<td style="padding:22px" class="cell100 column5">@if ($orders->order->status == 'pending')
                                                    <span id="order-status" class=" bg-warning text-white">Pending</span>
                                            @elseif($orders->order->status == 'Processing')-->
                                                    <span id="order-status" class=" bg-info text-white">Processing</span>
                                               @elseif($orders->order->status == 'Completed')-->
                                                    <span id="order-status" class=" bg-success text-white">Completed</span>
                                                    @elseif($orders->order->status == 'Declined')-->
                                                    <span id="order-status" class=" bg-danger text-white">Declined</span>
                                                    @elseif($orders->order->status == 'On Delivery')-->
                                                  <span id="order-status" class=" bg-dark text-white">On Delivery</span>
                                               @endif</td>
                                    <td style="padding:22px" class="cell100 column5">{{$orders->order->created_at->format('d-m-Y')}}</td>   
                                 
								</tr>
								   @endforeach

							
							</tbody>
						</table>
					</div>
				</div>
            </div>
        </div>
            <div class="col-lg-6">
                <div class="special-box">
                    <div  class="heading-area">
                        <h4 class="title">
                        Billing Details
                        </h4>
                    </div>
                    <div class="table-responsive-sm border shadow">
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
                    <!-- End of Account Address -->

                    <a href="/" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6"><i class="w-icon-long-arrow-left"></i>Back</a>
                </div>
            </div>
            <!-- End of PageContent -->

        </main>


        <script>
            localStorage.clear();
          
if (window.history.replaceState) {
    window.history.replaceState(null, null, '/viewcart');
}


let button = document.queryselector('.check')

button.addEventListener("click", myFunction);

function myFunction() {
  Hypershop.postMessage('suce');
}
 </script>

 <script>

for(i=0; i<100; i++) {
  // Random rotation
  var randomRotation = Math.floor(Math.random() * 360);
    // Random Scale
  var randomScale = Math.random() * 1;
  // Random width & height between 0 and viewport
  var randomWidth = Math.floor(Math.random() * Math.max(document.documentElement.clientWidth, window.innerWidth || 0));
  var randomHeight =  Math.floor(Math.random() * Math.max(document.documentElement.clientHeight, window.innerHeight || 500));
  
  // Random animation-delay
  var randomAnimationDelay = Math.floor(Math.random() * 15);
  console.log(randomAnimationDelay);

  // Random colors
  var colors = ['#0CD977', '#FF1C1C', '#FF93DE', '#5767ED', '#FFC61C', '#8497B0']
  var randomColor = colors[Math.floor(Math.random() * colors.length)];

  // Create confetti piece
  var confetti = document.createElement('div');
  confetti.className = 'confetti';
  confetti.style.top=randomHeight + 'px';
  confetti.style.right=randomWidth + 'px';
  confetti.style.backgroundColor=randomColor;
  // confetti.style.transform='scale(' + randomScale + ')';
  confetti.style.obacity=randomScale;
  confetti.style.transform='skew(15deg) rotate(' + randomRotation + 'deg)';
  confetti.style.animationDelay=randomAnimationDelay + 's';
  document.getElementById("confetti-wrapper").appendChild(confetti);
}
 </script>

        @endsection