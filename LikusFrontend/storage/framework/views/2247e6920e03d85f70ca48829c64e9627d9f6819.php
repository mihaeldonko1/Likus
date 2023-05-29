
<?php
    $suffix = '';
    $suffixes = [];
    if(isset($currentCategoryId) && $currentCategoryId){
        $suffixes[]= 'recommended_category_id='.$currentCategoryId;
    }
    if(isset($currentPageId) && $currentPageId){
        $suffixes[]= 'recommended_content_id='.$currentPageId;
    }

    if($suffixes){
        $suffix = '?'.implode('&', $suffixes);
    }

    if(!isset($contentType)){
        $contentType = 'content';
    }

   if(!isset($buttonClass)){
        $buttonClass = 'btn btn-primary btn-rounded';
    }
?>



<?php if($contentType == 'post'): ?>
    <a href="<?php echo e(route('admin.post.create')); ?><?php echo e($suffix); ?>" class="<?php echo e($buttonClass); ?>"><?php _e('Add post'); ?></a>
<?php endif; ?>

<?php if($contentType == 'product'): ?>
    <a href="<?php echo e(route('admin.product.create')); ?><?php echo e($suffix); ?>" class="<?php echo e($buttonClass); ?>"><?php _e('Add product'); ?></a>
<?php endif; ?>

<?php if($contentType == 'page'): ?>


    <a href="<?php echo e(route('admin.page.create')); ?><?php echo e($suffix); ?>" class="<?php echo e($buttonClass); ?>"><?php _e('Add page'); ?></a>
<?php endif; ?>

<?php if($contentType == 'content'): ?>



    <div class="btn-group">
        <button type="button" class="<?php echo e($buttonClass); ?> dropdown-toggle hidden-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                <?php _e('Create content'); ?>
        </button>
        <ul class="dropdown-menu">
            <a href="<?php echo e(route('admin.page.create')); ?><?php echo e($suffix); ?>" class="dropdown-item <?php echo e($buttonClass); ?>"><?php _e('Add page'); ?></a>
            <a href="<?php echo e(route('admin.post.create')); ?><?php echo e($suffix); ?>" class="dropdown-item <?php echo e($buttonClass); ?>"><?php _e('Add post'); ?></a>
            <?php if (is_shop_module_enabled_for_user()): ?>
            <a href="<?php echo e(route('admin.product.create')); ?><?php echo e($suffix); ?>" class="dropdown-item <?php echo e($buttonClass); ?>"><?php _e('Add product'); ?></a>
            <?php endif; ?>
        </ul>
    </div>

<?php endif; ?>
<?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/create-content-buttons.blade.php ENDPATH**/ ?>