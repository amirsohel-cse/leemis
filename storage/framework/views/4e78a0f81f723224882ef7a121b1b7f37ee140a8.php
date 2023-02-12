
<?php $__env->startSection('content'); ?>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo e(('frontend/assets/css/style.min.css')); ?>">
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

@keyframes  scaleCup {
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

@keyframes  confettiRain {
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
                            <strong><?php echo e($orders[0]->order->order_id); ?></strong>
                        </li>
                        <li class="shadow">
                            <label>Status</label>
                            <strong><?php echo e($orders[0]->order->status); ?></strong>
                        </li>
                        <li class="shadow">
                            <label>Date</label>
                            <strong><?php echo e($orders[0]->order->created_at->format('d-m-Y')); ?></strong>
                        </li>
                        <li class="shadow">
                            <label>Total</label>
                            <strong><?php echo e($orders[0]->order->total); ?></strong>
                        </li>
                           <li class="shadow">
                            <label>Shipping</label>
                            <strong><?php echo e($orders[0]->order->shipping_method); ?></strong>
                        </li>
                        <li class="shadow">
                            <label>Payment method</label>
                            <strong><?php echo e(($orders[0]->order->payment_method == 'cash on') ? "Cash On Delivery" : "Paid"); ?></strong>
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
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="p-3">
                                            <a href="#"><?php echo e($item->product->name); ?></a>&nbsp;<strong>x <?php echo e($item->qty); ?></strong><br>
                                            <small>color: <?php echo e($orders[0]->color); ?></small> <br>
                                            <span><small>Size: <?php echo e($orders[0]->size); ?></small></span><br>
                                            
                                        </td>
                                        <td class="p-3"><?php echo e($item->qty* $item->product->price); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="p-3">Subtotal:</th>
                                        <td class="p-3"><?php echo e($orders[0]->order->subtotal); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="p-3">Shipping:</th>
                                        <td class="p-3"><?php echo e($orders[0]->order->shipping_method); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="p-3">Payment method:</th>
                                        <td class="p-3"><?php echo e($orders[0]->order->payment_method); ?></td>
                                    </tr>
                                    <tr class="total bg-success">
                                        <th class="border-no p-3 text-white">Total:</th>
                                        <td class="border-no p-3 text-white"><?php echo e($orders[0]->order->total); ?></td>
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
                                                        <td ><?php echo e($orders[0]->order->name); ?></td>
                                                    </tr>
                                                    <tr class="p-2">
                                                        <th class="p-3">Address</th>
                                                        <td ><?php echo e($orders[0]->order->address); ?></td>
                                                    </tr>
                                                    <tr class="p-2">
                                                        <th class="p-3">City</th>
                                                        <td ><?php echo e($orders[0]->order->city); ?></td>
                                                    </tr>
                                                    <tr class="p-2">
                                                        <th class="p-3">Zip</th>
                                                        <td ><?php echo e($orders[0]->order->zip); ?></td>
                                                    </tr>
                                                    
                                                   
                                                    <tr class="p-2">
                                                        <th class="p-3">Contact Number</th>
                                                        <td><?php echo e($orders[0]->order->phone); ?></td>
                                                    </tr>
                                                    <tr class="email p-3">
                                                        <th class="p-3">E-mail</th>
                                                        <td><?php echo e($orders[0]->order->email); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                       
                                    </div>
                                </div>
                                
                           
                        </div>
                    </div> -->

                <div class="row">
            <div class="col-lg-12">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                        Order Id : #<?php echo e($orders[0]->order->order_id); ?>

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
								 <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<tr class="row100 body border-bottom">

									<td style="padding:22px" class="cell100 column1"><a href=<?php echo e(url('productdetails',$orders->product->id.'/'.$orders->product->slug)); ?>><?php echo e($orders->product->name); ?></a></td>
                                    <td style="padding:22px" class="cell100 column1"><img width="100" src="<?php echo e($orders->product->photo); ?>"</td>
                                    <td style="padding:22px" class="cell100 column2"><?php if(isset($orders->product->vendor->shop_name)): ?><a href="<?php echo e(route('shop.product',[$orders->product->vendor->id,Str::slug($orders->product->vendor->shop_name)])); ?>"><?php echo e($orders->product->vendor->shop_name); ?></a><?php endif; ?></td>
									<td style="padding:22px" class="cell100 column3"><?php echo e($orders->product->price); ?></td>
                                    <td style="padding:22px" class="cell100 column5">
                                        <?php if($orders->attributes != null): ?>
                                                <?php $__currentLoopData = $orders->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p><?php echo e(\App\Model\CategoryAttribute::find($attr['attribute'])->name); ?> : <?php echo e(\App\Model\AttributeOption::find($attr['option'])->option); ?></p>
                                                        
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                           <?php else: ?>

                                            

                                           <?php endif; ?>
                                    </td>
                                    <td class="cell100 column4">
                                        <?php echo e($orders->additional_price * $orders->qty); ?>

                                    </td>
									 
									<td style="padding:22px" class="cell100 column4"><?php echo e($orders->order->payment_method); ?></td>
									<td style="padding:22px" class="cell100 column5"><?php echo e($orders->qty); ?></td>
									
									
									<td style="padding:22px" class="cell100 column5"><?php if($orders->order->status == 'pending'): ?>
                                                    <span id="order-status" class=" bg-warning text-white">Pending</span>
                                            <?php elseif($orders->order->status == 'Processing'): ?>-->
                                                    <span id="order-status" class=" bg-info text-white">Processing</span>
                                               <?php elseif($orders->order->status == 'Completed'): ?>-->
                                                    <span id="order-status" class=" bg-success text-white">Completed</span>
                                                    <?php elseif($orders->order->status == 'Declined'): ?>-->
                                                    <span id="order-status" class=" bg-danger text-white">Declined</span>
                                                    <?php elseif($orders->order->status == 'On Delivery'): ?>-->
                                                  <span id="order-status" class=" bg-dark text-white">On Delivery</span>
                                               <?php endif; ?></td>
                                    <td style="padding:22px" class="cell100 column5"><?php echo e($orders->order->created_at->format('d-m-Y')); ?></td>   
                                 
								</tr>
								   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							
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
                                    <td width="45%"><?php echo e($orders->order->name); ?></td>
                                </tr>
                                <tr>
                                    <th width="45%">Email</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><?php echo e($orders->order->email); ?></td>
                                </tr>
                                <tr>
                                    <th width="45%">Phone</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><?php echo e($orders->order->phone); ?></td>
                                </tr>
                                <tr>
                                    <th width="45%">Address</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><?php echo e($orders->order->address); ?></td>
                                </tr>
                             
                                <tr>
                                    <th width="45%">City</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><?php echo e($orders->order->city); ?></td>
                                </tr>
                                <tr>
                                    <th width="45%">Zip Code</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><?php echo e($orders->order->zip); ?></td>
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

        <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/frontend/order_complete.blade.php ENDPATH**/ ?>