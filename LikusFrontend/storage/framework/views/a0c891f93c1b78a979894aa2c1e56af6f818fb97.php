<div class="pt-0">

    <?php echo $__env->make('content::admin.content.index-page-category-tree', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="module-content">

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin-content-list', [])->html();
} elseif ($_instance->childHasBeenRendered('lMcagOm')) {
    $componentId = $_instance->getRenderedChildComponentId('lMcagOm');
    $componentTag = $_instance->getRenderedChildComponentTagName('lMcagOm');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('lMcagOm');
} else {
    $response = \Livewire\Livewire::mount('admin-content-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('lMcagOm', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin-content-bulk-options', [])->html();
} elseif ($_instance->childHasBeenRendered('6NYqKQk')) {
    $componentId = $_instance->getRenderedChildComponentId('6NYqKQk');
    $componentTag = $_instance->getRenderedChildComponentTagName('6NYqKQk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('6NYqKQk');
} else {
    $response = \Livewire\Livewire::mount('admin-content-bulk-options', []);
    $html = $response->html();
    $_instance->logRenderedChild('6NYqKQk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    </div>
</div>

<?php echo $__env->make('content::admin.content.index-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/index.blade.php ENDPATH**/ ?>