<div id="content-results-table">
    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="card card-product-holder mb-2 post-has-image-true manage-post-item">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center flex-lg-box">

                    <div class="col text-center manage-post-item-col-1" style="max-width: 40px;">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="<?php echo e($content->id); ?>" id="products-<?php echo e($content->id); ?>"  class="js-select-posts-for-action custom-control-input" wire:model="checked">
                            <label for="products-<?php echo e($content->id); ?>" class="custom-control-label"></label>
                        </div>
                        <span class="btn btn-link text-muted px-0 js-move mw_admin_posts_sortable_handle" onmousedown="mw.manage_content_sort()">
                            <i class="mdi mdi-cursor-move"></i>
                        </span>
                    </div>

                    <div class="col manage-post-item-col-2" style="max-width: 120px; min-width: 120px;">

                        <?php echo $__env->make('content::admin.content.livewire.components.picture', ['content'=>$content], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>

                    <div class="col item-title manage-post-item-col-3 manage-post-main">

                        <?php echo $__env->make('content::admin.content.livewire.components.title-and-categories', ['content'=>$content], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('content::admin.content.livewire.components.manage-links', ['content'=>$content], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>

                    <div class="col item-author manage-post-item-col-4 d-xl-block d-none">
                        <span class="text-muted" title="<?php echo e($content->authorName()); ?>"><?php echo e($content->authorName()); ?></span>
                    </div>

                </div>
            </div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\Miha\Desktop\Praktikum2\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/display-types/card.blade.php ENDPATH**/ ?>