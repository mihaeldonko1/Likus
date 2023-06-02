<?php if(isset($recommended_content_id) and isset($recommended_category_id) and $content_id == 0): ?>
    <?php
echo app()->parser->process("<module ".app()->format->arrayToHtmlAttributes(['type' => 'content/edit','content_id' => ''.e($content_id).'','parent' => ''.e($recommended_content_id).'','id' => 'main-content-edit-admin','category' => ''.e($recommended_category_id).''])." />");
?>
<?php else: ?>
    <?php
echo app()->parser->process("<module ".app()->format->arrayToHtmlAttributes(['type' => 'content/edit','content_id' => ''.e($content_id).'','id' => 'main-content-edit-admin'])." />");
?>
<?php endif; ?>
<?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\LikusFrontend\src\MicroweberPackages\Content\resources\views/admin/content/edit.blade.php ENDPATH**/ ?>