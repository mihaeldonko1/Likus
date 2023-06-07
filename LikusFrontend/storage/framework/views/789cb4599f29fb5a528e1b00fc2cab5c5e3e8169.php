<div>
    <script><?php echo file_get_contents(resource_path() . '/views/vendor/livewire-ui-modal/bootstrap-modal.js'); ?></script>

    <div

        x-data="LivewireUIBootstrapModal()"
        x-init="init()"
        x-on:close.stop="setShowPropertyTo(false)"
        x-on:keydown.escape.window="closeModalOnEscape()"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
        x-show="show"

        class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <?php $__empty_1 = true; $__currentLoopData = $components; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div x-show.immediate="activeComponent == '<?php echo e($id); ?>'" x-ref="<?php echo e($id); ?>" wire:key="<?php echo e($id); ?>">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($component['name'], $component['attributes'])->html();
} elseif ($_instance->childHasBeenRendered($id)) {
    $componentId = $_instance->getRenderedChildComponentId($id);
    $componentTag = $_instance->getRenderedChildComponentTagName($id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild($id);
} else {
    $response = \Livewire\Livewire::mount($component['name'], $component['attributes']);
    $html = $response->html();
    $_instance->logRenderedChild($id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\LikusFrontend\resources\views/vendor/livewire-ui-modal/modal.blade.php ENDPATH**/ ?>