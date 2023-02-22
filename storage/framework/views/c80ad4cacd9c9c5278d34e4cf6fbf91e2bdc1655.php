<?php $__env->startSection('main-content'); ?>


<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-header">
                    <button type="button" data-toggle="modal" data-target="#adModal" class="btn btn-primary mr-3 mt-2"><i class="la la-plus"></i><?php echo app('translator')->get('Ad New'); ?></button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('Advertisement Type'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Ad Size'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Ad Image'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $advertisements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td data-label="<?php echo app('translator')->get('Advertisement Type'); ?>"><span class="text-small badge font-weight-normal <?php echo e($advr->type == 1 ? 'badge--success':'badge-primary'); ?>"><?php echo e($advr->type == 1 ? 'Banner':'Script'); ?></span></td>
                                <td data-label="><?php echo app('translator')->get('Resolution'); ?>"><span class="text-small badge font-weight-normal badge--primary"><?php echo e($advr->resolution); ?></span></td>
                                <?php if($advr->type == 1): ?>
                                  <td data-label="<?php echo app('translator')->get('Ad Image'); ?>"> <a class="btn btn-sm btn-dark" href="<?php echo e(getImage('assets/images/advertisement/'.$advr->ad_image)); ?>"  data-rel="lightcase"> <i class="las la-eye"></i> <?php echo app('translator')->get('see'); ?></a></td>
                                <?php else: ?>
                                   <td <?php echo app('translator')->get('Ad Image'); ?>> <?php echo app('translator')->get('N/A'); ?></td>
                                <?php endif; ?>


                                <td data-label="<?php echo app('translator')->get('Status'); ?>"><span class="text-small badge font-weight-normal <?php echo e($advr->status == 1 ? 'badge--success':'badge-warning'); ?>"><?php echo e($advr->status == 1 ? 'active':'inactive'); ?></span></td>

                                <td data-label="Action">
                                    <a href="javascript:void(0)" data-advr="<?php echo e($advr); ?>" data-route="<?php echo e(route('advertisements.update',$advr->id)); ?>" class="btn btn-primary mr-2 edit" data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                        <i class="fa fa-edit text--shadow"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-route="<?php echo e(route('advertisements.remove',$advr->id)); ?>" class="btn btn-danger delete" data-toggle="tooltip" title="<?php echo app('translator')->get('Delete'); ?>">
                                        <i class="fa fa-trash text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e($empty_message); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                 <?php echo e($advertisements->links()); ?>

                </div>
            </div><!-- card end -->
        </div>


        <div class="modal fade" id="adModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="<?php echo e(route('advertisements.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header bg--primary">
                        <h5 class="modal-title "><?php echo app('translator')->get('Ad new advertisement'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         <div class="form-group">
                            <label ><?php echo app('translator')->get('Fixed Slider Advertisement '); ?></label>
                            <select class="form-control" name="is_slider" required>
                                <option value="0"><?php echo app('translator')->get('No'); ?></option>
                                <option value="1"><?php echo app('translator')->get('Yes'); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label ><?php echo app('translator')->get('Select Type'); ?></label>
                            <select class="form-control type" name="type" required>
                                <option value="1"><?php echo app('translator')->get('Banner'); ?></option>
                                <option value="2"><?php echo app('translator')->get('Script'); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label ><?php echo app('translator')->get('Select Ad Size'); ?></label>
                            <select class="form-control" name="size" required>
                                <option value="160x230"><?php echo app('translator')->get('160x230'); ?></option>
                                <option value="224x295"><?php echo app('translator')->get('224x295'); ?></option>
                                <option value="356x221"><?php echo app('translator')->get('356x221'); ?></option>
                                <option value="356x250"><?php echo app('translator')->get('356x250'); ?></option>
                                <option value="442x165"><?php echo app('translator')->get('442x165'); ?></option>
                                <option value="710x185"><?php echo app('translator')->get('710x185'); ?></option>
                                <option value="1440x250"><?php echo app('translator')->get('1440x250'); ?></option>
                                <option value="1440x80"><?php echo app('translator')->get('1440x80'); ?></option>

                            </select>
                        </div>
                        <div class="form-group ru">
                            <label ><?php echo app('translator')->get('Redirect Url'); ?></label>
                            <input type="text" class="form-control" name="redirect_url" placeholder="<?php echo app('translator')->get('http/https://example.com'); ?>" required value="<?php echo e(old('redirect_url')); ?>">
                        </div>

                        <div class="form-group adfile">
                            <label ><?php echo app('translator')->get('Ad Image'); ?></label>
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"> <input type="file" class="form-control-file" name="adimage" required id="img"> </li>
                        </div>

                        <div class="form-group script d-none">
                            <label ><?php echo app('translator')->get('Ad Script'); ?></label>
                            <textarea type="text" class="form-control" disabled name="script" required><?php echo e(old('script')); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Status'); ?> </label>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"
                                   data-toggle="toggle" data-on="<?php echo app('translator')->get('Active'); ?>" data-off="<?php echo app('translator')->get('Inactive'); ?>" name="status"
                                  >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Save'); ?></button>
                    </div>
                </div>
               </form>
            </div>
        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title "><?php echo app('translator')->get('Edit Advertisement'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label ><?php echo app('translator')->get('Fixed Slider Advertisement '); ?></label>
                            <select class="form-control" name="is_slider" required>
                                <option value="0"><?php echo app('translator')->get('No'); ?></option>
                                <option value="1"><?php echo app('translator')->get('Yes'); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label ><?php echo app('translator')->get('Select Type'); ?></label>
                            <select class="form-control type" name="type" required readonly>
                                <option value="1"><?php echo app('translator')->get('Banner'); ?></option>
                                <option value="2"><?php echo app('translator')->get('Script'); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label ><?php echo app('translator')->get('Select Ad Size'); ?></label>
                            <select class="form-control" name="size" required>
                                <option value="160x230"><?php echo app('translator')->get('160x230'); ?></option>
                                <option value="224x295"><?php echo app('translator')->get('224x295'); ?></option>
                                <option value="356x221"><?php echo app('translator')->get('356x221'); ?></option>
                                <option value="356x250"><?php echo app('translator')->get('356x250'); ?></option>
                                <option value="442x165"><?php echo app('translator')->get('442x165'); ?></option>
                                <option value="710x185"><?php echo app('translator')->get('710x185'); ?></option>
                                <option value="1440x250"><?php echo app('translator')->get('1440x250'); ?></option>
                                <option value="1440x80"><?php echo app('translator')->get('1440x80'); ?></option>
                            </select>
                        </div>
                        <div class="form-group ru">
                            <label ><?php echo app('translator')->get('Redirect Url'); ?></label>
                            <input type="text" class="form-control" name="redirect_url" placeholder="<?php echo app('translator')->get('http/https://example.com'); ?>" required value="<?php echo e(old('redirect_url')); ?>">
                        </div>

                        <div class="form-group adfile">
                            <label ><?php echo app('translator')->get('Ad Image'); ?></label>
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"> <input type="file" class="form-control-file" name="adimage" id="img"> </li>
                        </div>

                        <div class="form-group script d-none">
                            <label ><?php echo app('translator')->get('Ad Script'); ?></label>
                            <textarea type="text" class="form-control" disabled name="script" required><?php echo e(old('script')); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Status'); ?> </label>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"
                                   data-toggle="toggle" data-on="<?php echo app('translator')->get('Active'); ?>" data-off="<?php echo app('translator')->get('Inactive'); ?>" name="status"
                                  >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Save'); ?></button>
                    </div>
                </div>
               </form>
            </div>
        </div>


    
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
               <button type="button" class="close ml-auto m-3" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body text-center">

                            <i class="las la-exclamation-circle text-danger display-2 mb-15"></i>
                            <h4 class="text-secondary mb-15"><?php echo app('translator')->get('Are You Sure Want to Delete This?'); ?></h4>

                        </div>
                    <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('close'); ?></button>
                      <button type="submit"  class="btn btn-danger del"><?php echo app('translator')->get('Delete'); ?></button>
                    </div>

                    </form>
              </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('page-stylesheet'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

     <script>
            'use strict';
            (function ($) {
                $('.type').on("change",function () {
                    if($(this).val() == 1){
                        $('.ru').removeClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',false)
                        $('.adfile').removeClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',false)
                        $('.script').addClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',true)
                    } else if($(this).val() == 2) {
                        $('.ru').addClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',true)
                        $('.previmage').addClass("d-none")
                        $('.adfile').addClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',true)
                        $('.script').removeClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',false)
                    }
                })
                $('.edit').on('click',function () {
                    var modal = $('#editModal')
                    var advr = $(this).data('advr')
                    var route = $(this).data('route')
                    modal.find('select[name=type]').val(advr.type)
                    modal.find('select[name=is_slider]').val(advr.is_slider)
                    modal.find('select[name=size]').val(advr.resolution)
                    if(advr.redirect_url){
                      modal.find('input[name=redirect_url]').val(advr.redirect_url)
                    }
                    if(advr.script != null){
                        $('.ru').addClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',true)
                        $('.previmage').addClass("d-none")
                        $('.adfile').addClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',true)
                        $('.script').removeClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',false)
                        modal.find('textarea[name=script]').val(advr.script)
                    } else {
                        $('.ru').removeClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',false)
                        $('.adfile').removeClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',false)
                        $('.script').addClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',true)
                    }
                    if(advr.status == 1){
                      modal.find('input[name=status]').bootstrapToggle('on')
                    }
                    modal.find('form').attr('action',route)
                    modal.modal('show')
                })
                $('.delete').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#deleteModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('a[data-rel^=lightcase]').lightcase();
            })(jQuery);
     </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/admin/ads/advertisements.blade.php ENDPATH**/ ?>