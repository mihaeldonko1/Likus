<?php
$from_live_edit = false;
if (isset($params["live_edit"]) && $params["live_edit"]) {
    $from_live_edit = $params["live_edit"];
}
?>

<?php if (isset($params['backend'])): ?>
    <module type="admin/modules/info"/>
<?php endif; ?>

<div class="card style-1 mb-3 <?php if ($from_live_edit): ?>card-in-live-edit<?php endif; ?>">
    <div class="card-header">
        <module type="admin/modules/info_module_title" for-module="<?php print $params['module'] ?>"/>
    </div>
    <div class="card-body pt-3">
        <div class="module-live-edit-settings module-ants-settings">
            <div class="form-group">
                <label class="control-label"><?php _lang("id galerije", "modules/ants"); ?></label>
                <input name="id_skupine" class="form-control mw_option_field" type="number" value="<?php print get_option('id_skupine', $params['id']) ?>">
            </div>
            <div class="form-group">
                <label class="control-label"><?php _lang("Text pod galerijo", "modules/ants"); ?></label>
                <input name="text_galerije" class="form-control mw_option_field" type="text"  value="<?php print get_option('text_galerije', $params['id']) ?>">
            </div>
        </div>
    </div>
</div>