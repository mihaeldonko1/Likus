<?php if($content->media()->first()): ?>
    <div class="img-as-background border-radius-0 border-0">
      
        <img src="<?php echo e($content->thumbnail(640,480, true)); ?>" class="rounded-full">
    </div>
<?php else: ?>
    <?php echo $__env->make('content::admin.content.livewire.components.icon', ['content'=>$content], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Miha\Desktop\Praktikum2\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/components/picture.blade.php ENDPATH**/ ?>