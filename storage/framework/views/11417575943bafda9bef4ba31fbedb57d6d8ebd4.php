


<div class="sidebar-cart-wrapper">
    <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <?php if($cart_item->product != null): ?>
        <div style="width:240px" class="product product-cart sidebar-cart-product">
            <div class="product-detail">
                <a href="<?php echo e(route('product.details', [$cart_item->product->id, Str::slug($cart_item->product->name)])); ?>"
                    class="product-name"><?php echo e($cart_item->product->name); ?></a>
                <div class="price-box">
                    <span class="product-quantity"><?php echo e($cart_item->qty); ?></span>
                    <span class="product-price">Tk. <?php echo e($cart_item->subtotal); ?></span>
                </div>
            </div>
            <figure class="product-media">
                <a href="<?php echo e(route('product.details', [$cart_item->product->id, Str::slug($cart_item->product->name)])); ?>">
                    <img src="<?php echo e(asset($cart_item->product->photo)); ?>" alt="product" height="84" width="94">
                </a>
            </figure>
            <button data-id="<?php echo e($cart_item->id); ?>" class="btn btn-link btn-close cart-item-delete">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <?php if(auth()->guard()->check()): ?>
    <div class="sidebar-cart-footer">
        <div class="cart-total">
            <label><?php echo e(languageChange('Subtotal')); ?>:</label>
            <span class="price"><?php echo e(\App\Model\Cart::whereHas('product')->where('user_id', auth()->id())->sum('subtotal')); ?></span>
        </div>
    
        <div class="cart-action">
            <a href="<?php echo e(route('view.cart')); ?>"
                class="btn btn-dark btn-outline btn-rounded"><?php echo e(languageChange('View Cart')); ?></a>
            <a href="<?php echo e(route('checkout')); ?>" class="btn btn-primary  btn-rounded"
                id="sidebarCheckoutBtn"><?php echo e(languageChange('Checkout')); ?></a>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(auth()->guard()->guest()): ?>
        <div class="cart-action">
            <a href="<?php echo e(route('customer.login')); ?>" class="btn btn-dark btn-outline btn-rounded"
                style="width: auto"><?php echo e(__('Login To View Cart')); ?></a>
        </div>
    <?php endif; ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/frontend/cart_ajax.blade.php ENDPATH**/ ?>