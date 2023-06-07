<div class="manage-item-main-top">

    <a target="_self" href="<?php echo e(route('admin.page.edit', $content->id)); ?>" class="btn btn-link p-0">
        <h5 class="text-dark text-break-line-1 mb-0 manage-post-item-title">
            <?php echo e($content->title); ?>

        </h5>
    </a>

    <?php
        $getParentsAsLinks = app()->content_manager->get_parents_as_links($content->id, [
            'class'=>'btn btn-link p-0 text-muted mw-products-breadcrumb',
            'implode_symbol'=>' / ',
        ])
    ?>

    <?php if($getParentsAsLinks): ?>
        <div class="text-muted">
            <?php echo $getParentsAsLinks; ?>

        </div>
    <?php endif; ?>

    <?php if($content->categories->count() > 0): ?>
        <span class="manage-post-item-cats-inline-list">
            <?php
                $iCategory = 0;
            ?>
            <?php $__currentLoopData = $content->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($category->parent): ?>

                    <a onclick="livewire.emit('selectCategoryFromTableList', <?php echo e($category->parent->id); ?>);return false;" href="?filters[category]=<?php echo e($category->parent->id); ?>&showFilters[category]=1"
                       class="btn btn-link btn-sm p-0">
                        <?php echo e($category->parent->title); ?>

                     </a>

                    <?php
                        $iCategory++;
                        if ($content->categories->count() !== $iCategory) {
                            echo ", ";
                        }
                    ?>

                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </span>
    <?php endif; ?>
    <a class="manage-post-item-link-small mw-medium d-none d-lg-block" target="_self"
       href="<?php echo e($content->link()); ?>">
        <small class="text-muted"><?php echo e($content->link()); ?></small>
    </a>
</div>
<?php /**PATH C:\Users\Miha\Desktop\Praktikum2\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/components/title-and-categories.blade.php ENDPATH**/ ?>