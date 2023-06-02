<div class="d-flex align-items-center ">
    <label class="d-xl-block d-none mx-2"><?php echo e(_e('Sort')); ?></label>
    <select wire:model.stop="filters.orderBy" class="form-select form-select-sm mw-form-select-filters">
        <option value=""><?php echo e(_e('Any')); ?></option>
        <option value="id,desc"><?php echo e(_e('Id Desc')); ?></option>
        <option value="id,asc"><?php echo e(_e('Id Asc')); ?></option>
    </select>
</div>
<?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/components/sort.blade.php ENDPATH**/ ?>