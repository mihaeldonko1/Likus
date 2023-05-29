<div class="manage-post-item-links mt-3">

    <a href="<?php echo e($content->editLink()); ?>" class="btn btn-outline-primary btn-sm">Edit</a>
    <a href="<?php echo e($content->editLink()); ?>" class="btn btn-outline-success btn-sm">Live Edit</a>

    <?php if(!$content->is_deleted): ?>
    <a href="javascript:mw.admin.content.delete('<?php echo e($content->id); ?>');" class="btn btn-outline-danger btn-sm js-delete-content-btn-<?php echo e($content->id); ?>">Delete</a>
    <?php endif; ?>
    <?php if($content->is_active < 1): ?>
        <a href="javascript:mw.admin.content.publishContent('<?php echo e($content->id); ?>');" class="mw-set-content-unpublish badge badge-warning font-weight-normal">Unpublished</a>

    <?php endif; ?>
</div>

<?php if($isInTrashed): ?>
    <?php echo $__env->make('content::admin.content.livewire.components.trash-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/components/manage-links.blade.php ENDPATH**/ ?>