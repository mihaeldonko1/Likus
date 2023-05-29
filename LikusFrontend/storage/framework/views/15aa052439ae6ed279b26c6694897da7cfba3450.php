<div class="card style-1 mb-3">

    <?php echo $__env->make('content::admin.content.livewire.card-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card-body pt-3">

        <?php echo $__env->make('content::admin.content.livewire.table-includes.table-tr-reoder-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if($displayFilters): ?>
        <div class="d-flex flex-wrap">

            <?php echo $__env->make('content::admin.content.livewire.components.keyword', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="col-xl-2 col-sm-3 col-12 mb-3 mb-md-0 ps-0">
                <?php echo $__env->make('content::admin.content.livewire.components.button-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="dropdown-menu p-1" style="width:250px;max-height:400px;overflow:auto;overflow-x:hidden;">

                    <?php if(!empty($dropdownFilters)): ?>
                        <?php $__currentLoopData = $dropdownFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dropdownFilterGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                 <h6 class="dropdown-header"><?php echo e($dropdownFilterGroup['groupName']); ?></h6>
                                <?php $__currentLoopData = $dropdownFilterGroup['filters']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dropdownFilter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="dropdown-item"><input type="checkbox" wire:model="showFilters.<?php echo e($dropdownFilter['key']); ?>"> <?php echo e($dropdownFilter['name']); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>
            </div>

            <?php if(!empty($appliedFiltersFriendlyNames)): ?>
                <?php echo $__env->make('content::admin.content.livewire.components.button-clear-filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="d-flex flex-wrap mt-3">

        <?php
        if(!empty($dropdownFilters)) {
            foreach($dropdownFilters as $dropdownFilterGroup) {
                foreach($dropdownFilterGroup['filters'] as $dropdownFilter) {
                    $skipDropdownFilter = false;
                    if(isset($dropdownFilter['type']) && $dropdownFilter['type'] == 'separator') {
                        $skipDropdownFilter = true;
                    }
                    if (!$skipDropdownFilter) {

                        if (isset($dropdownFilter['key']) && strpos($dropdownFilter['key'], '.') !== false) {
                                $dropdownFilterExp = explode('.', $dropdownFilter['key']);
                                if (isset($showFilters[$dropdownFilterExp[0]][$dropdownFilterExp[1]])) {
                                    ?>
                                         <?php echo $__env->make('content::admin.content.livewire.table-filters.' . $dropdownFilterExp[0], [
                                            'fieldName'=>$dropdownFilter['name'],
                                            'fieldKey'=>$dropdownFilterExp[1],
                                            'fieldValue'=>$showFilters[$dropdownFilterExp[0]][$dropdownFilterExp[1]],
                                           ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php
                                }
                            continue;
                        }


                        if (isset($showFilters[$dropdownFilter['key']]) && $showFilters[$dropdownFilter['key']]) {
                         ?>
                            <?php if(isset($dropdownFilter['viewNamespace'])): ?>
                                <?php echo $__env->make($dropdownFilter['viewNamespace'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('content::admin.content.livewire.table-filters.'.$dropdownFilter['key'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php
                        }
                    }
                }
            }
        }
        ?>

        </div>
        <div class="row  mt-3">
            <?php if(count($checked) > 0): ?>

                <?php if(count($checked) == count($contents->items())): ?>
                    <div class="col-md-10 mb-2">
                        You have selected all <?php echo e(count($checked)); ?> items.
                        <button type="button" class="btn btn-outline-danger btn-sm" wire:click="deselectAll"><?php echo e(_e('Deselect All')); ?></button>
                    </div>
                <?php else: ?>
                    <div>
                        You have selected <?php echo e(count($checked)); ?> items,
                        Do you want to Select All <?php echo e(count($contents->items())); ?>?
                        <button type="button" class="btn btn-link btn-sm" wire:click="selectAll"><?php echo e(_e('Select All')); ?></button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(count($checked) > 0): ?>
                <div class="pull-left">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo e(_e('Bulk Actions')); ?>

                        </button>
                        <ul class="dropdown-menu">
                            <li><button class="dropdown-item" type="button" wire:click="multipleMoveToCategory"><?php echo e(_e('Move To Category')); ?></button></li>
                            <li><button class="dropdown-item" type="button" wire:click="multiplePublish"><?php echo e(_e('Publish')); ?></button></li>
                            <li><button class="dropdown-item" type="button" wire:click="multipleUnpublish"><?php echo e(_e('Unpublish')); ?></button></li>
                            <li><button class="dropdown-item" type="button" wire:click="multipleDelete"><?php echo e(_e('Move to trash')); ?></button></li>
                            <li><button class="dropdown-item" type="button" wire:click="multipleDeleteForever"><?php echo e(_e('Delete Forever')); ?></button></li>
                            <?php if($isInTrashed): ?>
                            <li><button class="dropdown-item" type="button" wire:click="multipleUndelete"><?php echo e(_e('Restore from trash')); ?></button></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if($contents->total() > 0): ?>
            <div class="row mt-3">
                <div class="d-flex flex-wrap bulk-actions-show-columns mw-js-loading position-relative mb-1">

                    <?php echo $__env->make('content::admin.content.livewire.components.display-as', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="col-md-7 col-12 d-flex justify-content-end align-items-center px-0 mw-filters-sorts-mobile">

                        <?php echo $__env->make('content::admin.content.livewire.components.sort', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('content::admin.content.livewire.components.limit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="">
                            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle ms-2" style="padding: 10px;" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo e(_e('Columns')); ?>

                            </button>
                            <div class="dropdown-menu p-3">
                                <?php $__currentLoopData = $showColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column=>$columnShow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label wire:key="show-column-<?php echo e($loop->index); ?>" class="dropdown-item"><input type="checkbox" wire:model="showColumns.<?php echo e($column); ?>"> <?php echo e(_e(ucfirst($column))); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">

                    <?php if($displayType == 'card'): ?>
                        <?php if(isset($this->displayTypesViews['card'])): ?>
                            <?php echo $__env->make($this->displayTypesViews['card'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('content::admin.content.livewire.display-types.card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if($displayType == 'table'): ?>
                        <?php if(isset($this->displayTypesViews['table'])): ?>
                            <?php echo $__env->make($this->displayTypesViews['table'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('content::admin.content.livewire.display-types.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>

            <div class="d-flex justify-content-center">

                <div style="width: 100%">
                    <span class="text-muted"><?php echo e($contents->total()); ?> results found</span>
                </div>

                <div>
                    <?php echo e($contents->links()); ?>

                </div>
            </div>

        <?php else: ?>
            <?php echo $__env->make('content::admin.content.livewire.no-results-for-filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/livewire/table.blade.php ENDPATH**/ ?>