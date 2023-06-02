<div class="pt-0">

    <?php echo $__env->make('content::admin.content.index-page-category-tree', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="module-content">

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin-pages-list', [])->html();
} elseif ($_instance->childHasBeenRendered('NTROV4Q')) {
    $componentId = $_instance->getRenderedChildComponentId('NTROV4Q');
    $componentTag = $_instance->getRenderedChildComponentTagName('NTROV4Q');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('NTROV4Q');
} else {
    $response = \Livewire\Livewire::mount('admin-pages-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('NTROV4Q', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin-content-bulk-options', [])->html();
} elseif ($_instance->childHasBeenRendered('ti2qTKw')) {
    $componentId = $_instance->getRenderedChildComponentId('ti2qTKw');
    $componentTag = $_instance->getRenderedChildComponentTagName('ti2qTKw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ti2qTKw');
} else {
    $response = \Livewire\Livewire::mount('admin-content-bulk-options', []);
    $html = $response->html();
    $_instance->logRenderedChild('ti2qTKw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    </div>
</div>

<?php echo $__env->make('content::admin.content.index-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\LikusFrontend\src\MicroweberPackages\Page/resources/views/admin/page/index.blade.php ENDPATH**/ ?>