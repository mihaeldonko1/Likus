<?php if(empty($customFieldNames)): ?>
    <div class="alert alert-warning">
        <?php echo e(_e('There is no custom fields found for posts from selected blog page.')); ?>

    </div>
<?php else: ?>
<script>
    if (typeof mw !== "undefined") {
        mw.options.form('.js-filtering-custom-fields-table-holder', function () {
            mw.notification.success("<?php _ejs("Changes are saved"); ?>.");
        });
    }
</script>
<table class="table js-filtering-custom-fields-table-holder">
    <thead>
    <tr>
        <td style="width:40px"></td>
        <td><?php _e("Name"); ?></td>
        <td><?php _e("Custom Field"); ?></td>
        <td><?php _e("Control"); ?></td>
        <td><?php _e("Enable"); ?></td>
    </tr>
    </thead>

    <?php $__currentLoopData = $customFieldNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customFieldKey=>$customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="js-filter-custom-field-holder vertical-align-middle show-on-hover-root" data-field-custom-field-key="<?php echo e($customFieldKey); ?>">
            <td>
                <i data-title="<?php _e("Reorder filters"); ?>" data-bs-toggle="tooltip" class="js-filter-custom-field-handle-field mdi mdi-cursor-move mdi-18px text-muted show-on-hover" style="cursor: pointer;"></i>
            </td>
            <td>
                <input type="text" class="form-control mw_option_field" value="<?php echo e($customField->controlName); ?>" name="filtering_by_custom_fields_control_name_<?php echo e($customFieldKey); ?>" />
            </td>
            <td>
                <?php echo e($customField->name); ?>

            </td>

            <td>
                <?php
                    $customFieldControlTypeOptionName = 'filtering_by_custom_fields_control_type_' . $customFieldKey;
                ?>
                <select class="mw_option_field form-control" name="<?php echo e($customFieldControlTypeOptionName); ?>">
                    <option value="" disabled="disabled"><?php _e("Select control type"); ?></option>
                    <option value="checkbox" <?php if ('checkbox' == $customField->controlType): ?>selected="selected"<?php endif; ?>><?php _e("Multiple choices"); ?></option>
                    <option value="radio" <?php if ('radio' == $customField->controlType): ?>selected="selected"<?php endif; ?>><?php _e("Single Choice"); ?></option>
                    <option value="select" <?php if ('select' == $customField->controlType): ?>selected="selected"<?php endif; ?>><?php _e("Dropdown"); ?></option>
                    <option value="square_checkbox" <?php if ('square_checkbox' == $customField->controlType): ?>selected="selected"<?php endif; ?>><?php _e("Square checkbox"); ?></option>
                    <option value="date_range" <?php if ('date_range' == $customField->controlType): ?>selected="selected"<?php endif; ?>><?php _e("Date Range"); ?></option>
                </select>
            </td>
            <td>
                <?php
                    $customFieldOptionName = 'filtering_by_custom_fields_' . $customFieldKey;
                ?>
                <div class="custom-control custom-switch pl-0">
                    <label class="d-inline-block mr-5" for="<?php echo e($customFieldOptionName); ?>"></label>
                    <input type="checkbox" <?php if ('1' == get_option($customFieldOptionName, $moduleId)): ?>checked="checked"<?php endif; ?> name="<?php echo e($customFieldOptionName); ?>" data-value-checked="1" data-value-unchecked="0" id="<?php echo e($customFieldOptionName); ?>" class="mw_option_field custom-control-input">
                    <label class="custom-control-label" for="<?php echo e($customFieldOptionName); ?>"></label>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php endif; ?>
<?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\Frontend\src\MicroweberPackages\Blog\resources\views\/admin/ajax_custom_fields_table.blade.php ENDPATH**/ ?>