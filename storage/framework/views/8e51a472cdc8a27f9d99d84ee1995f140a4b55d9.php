<div style="height:60px" class="sticky-footer sticky-content fix-bottom">
    <a href="/" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p><?php echo e(languageChange('Home')); ?></p>
    </a>
    <a href="#" class="sticky-link mobile-menu-toggle">
        <i class="w-icon-bars"></i>
        <p><?php echo e(languageChange('Menu')); ?></p>
    </a>
    <a href="/allshop" class="sticky-link">
        <i class="w-icon-category"></i>
        <p><?php echo e(languageChange('Shop')); ?></p>
    </a>
    
    <a href="<?php echo e(route('customer.profile')); ?>" class="sticky-link">
        <i class="w-icon-account"></i>
        <p><?php echo e(languageChange('Account')); ?></p>
    </a>
    <div class="cart-dropdown dir-up">
        <a href="<?php echo e(route('view.cart')); ?>" class="sticky-link">
            <i class="w-icon-cart"></i>
            <span style="right:12px;top:7px" class="cart-count"><?php echo e(\App\Model\Cart::where('user_id',auth()->id())->count()); ?></span>
            <p><?php echo e(languageChange('Cart')); ?></p>
        </a>
    </div>
  

</div>
<?php /**PATH /var/www/html/resources/views/components/frontend/sticky-footer.blade.php ENDPATH**/ ?>