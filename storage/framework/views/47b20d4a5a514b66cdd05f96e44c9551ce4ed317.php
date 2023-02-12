
<?php $__env->startSection('main-content'); ?>
<div class="block-header">
  <div class="row clearfix">
      <div class="col-lg-8 col-md-12 col-sm-12">
          <h1>Product</h1>
          <span>Dashboard</span> <i class="fa fa-angle-right"></i>
          <span>Product</span> <i class="fa fa-angle-right"></i>
          <span>Product Details</span>
      </div>
  </div>
</div>
  
      <div class="card">
          <div class="body">
            <div class="row">


            <div style="width:30%" class="table-responsive-sm ml-5">
                        <table class="table border">
                            <tbody>
                                <tr>
                                <th class="45%" width="45%">Product Name</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e($product->name); ?></td>
                            </tr>
                            
                            <tr>
                                <th class="45%" width="45%">Vendor Name</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(@$product->vendor->name); ?></td>
                            </tr>
                            
                            <tr>
                                <th class="45%" width="45%">Product Sku</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(@$product->sku); ?></td>
                            </tr>
                            
                             <tr>
                                <th class="45%" width="45%">Stock</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(@$product->stock); ?></td>
                            </tr>
                            
                            
                            <tr>
                                <th width="45%">Category</th>
                                <td width="10%">:</td>
                                <td width="45%"><?php echo e($product->categories->name); ?></td>
                            </tr>
                            <tr>
                                <th width="45%">Sub Category</th>
                                <td width="10%">:</td>
                                <td width="45%"><?php if(isset($product->sub_categories->name)): ?><?php echo e($product->sub_categories->name); ?><?php endif; ?></td>
                            </tr>
                            <tr>
                                <th width="45%">Child Category</th>
                                <td width="10%">:</td>
                                <td width="45%"><?php if(isset($product->child_categories->name)): ?><?php echo e($product->child_categories->name); ?><?php endif; ?></td>
                            </tr>
                            <tr>
                                <th width="45%">Price</th>
                                <td width="10%">:</td>
                                <td width="45%"><?php echo e($product->price); ?></td>
                            </tr>

                            <tr>
                                <th width="45%">Brand Name</th>
                                <th width="10%">:</th>
                                <td width="45%"><?php if(isset($product->brand->name)): ?><?php echo e($product->brand->name); ?><?php endif; ?></td>
                            </tr>

                           <tr>
                                   <th width="45%">
                                       Varient
                                   </th>
                                   
                                   <th width="10%">:</th>
                                   
                                   <th width="45%">
                                       <?php $__currentLoopData = $product->product_specification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      
                                        <?php 
                                            
                                            $attribute = \App\Model\CategoryAttribute::find($specification['category_attribute_id']);
                                            
                                            
                                            
                                        ?>
                                                            
                                                <div class="col-md-4">
                                                    <span><?php echo e($attribute->name); ?> : </span>
                                                    <?php $__currentLoopData = $attribute->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                        <?php if($specification['attribute'] == $option->id): ?>
                                                        <span><?php echo e($option->option); ?></span>,
                                                        <?php endif; ?>
                                                    
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   
                                                </div>
                                                
                                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </th>

                            <tr>
                                <th width="45%">Offer Product</th>
                                <th width="10%">:</th>
                                <td width="45%"><?php echo e($product->offer ?? 'N/A'); ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div style="width:60%" class=" ml-5">
                        <table  style="table-layout:fixed; width:100%;" >
                            <tbody>
                                <tr class="border" >
                                    <th width="25%" class="p-2">Product Image</th>
                                    <td width="5%" class="p-2">:</td>
                                    <td class="p-2" ><img src="<?php echo e(url($product->photo)); ?>" style="width:110px; height:80px;" ></td>
                                </tr>
                                <tr class="border p-2">
                                    <th class="p-2">Gallery Image</th>
                                    <td class="p-2">:</td>
                                    <td class="p-2"> <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><img  class="img-fluid" src="<?php echo e(asset('uploads')); ?>/product-gallery/<?php echo e($data->image_file); ?>" id="fetureInputGallery" style="height: 80px;width: 100px;">
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                </tr>
                                <tr class="border">
                                    <th class="p-2">Description</th>
                                    <td class="p-2">:</td>
                                    <td class="p-2" ><?php echo $product->details; ?></td>
                                </tr>
                                <tr class="border">
                                    <th class="p-2">Tags</th>
                                    <td class="p-2">:</td>
                                    <td class="p-2"><?php echo e($product->tags); ?></td>
                                </tr>
                                

                            </tbody>
                        </table>
                    </div>


             
         
          </div>
        </div>
          </div>
      </div>


  <?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/vendor/product/viewProduct.blade.php ENDPATH**/ ?>