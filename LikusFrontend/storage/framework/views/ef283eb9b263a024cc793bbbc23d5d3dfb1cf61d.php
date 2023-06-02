<div class="card-header d-flex align-items-center justify-content-between px-md-4">
    <div class="col d-flex justify-content-md-between justify-content-center align-items-center px-0">
        <h5 class="mb-0 d-flex">
            <i class="mdi mdi-earth text-primary mr-md-3 mr-1 justify-content-center"></i>

            <strong class="d-md-flex d-none">

                <a class="<?php if(isset($currentCategory) and $currentCategory): ?> text-decoration-none <?php else: ?> text-decoration-none text-dark <?php endif; ?>" onclick="livewire.emit('deselectAllCategories');return false;">
                    <?php echo e(_e('Website')); ?>

                </a>

                <?php if(isset($currentCategory) and $currentCategory): ?>
                    <span class="text-muted">&nbsp; &raquo; &nbsp;</span>
                    <?php echo e($currentCategory['title']); ?>

                <?php endif; ?>

                <?php if($isInTrashed): ?>
                    <span class="text-muted">&nbsp; &raquo; &nbsp;</span>
                    <i class="mdi mdi-trash-can"></i> <?php echo e(_e('Trash')); ?>

                <?php endif; ?>

            </strong>

            <?php if(isset($currentCategory) and $currentCategory): ?>
                <a class="ms-1 text-muted fs-5"  onclick="livewire.emit('deselectAllCategories');return false;">
                    <i class="fa fa-times-circle"></i>
                </a>
            <?php endif; ?>
        </h5>
        <div>

            <?php if(isset($contentType)): ?>
                <?php echo $__env->make('content::admin.content.livewire.create-content-buttons',['buttonClass'=>'btn btn-link btn-sm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php endif; ?>




            <?php
            /*  @if(isset($currentCategory) and $currentCategory)
            <a href="{{category_link($currentCategory['id'])}}" target="_blank" title="{{_e('View category')}}"><span class="fa fa-external-link-alt"></span></a>
            @endif*/

            ?>



        </div>
    </div>
</div>
<?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/card-header.blade.php ENDPATH**/ ?>