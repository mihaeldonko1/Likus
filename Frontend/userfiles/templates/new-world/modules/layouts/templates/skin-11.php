<?php

/*

type: layout

name: Jan Test

position: 100

*/

?>

<?php
if (!$classes['padding_top']) {
    $classes['padding_top'] = 'p-t-80';
}
if (!$classes['padding_bottom']) {
    $classes['padding_bottom'] = 'p-b-80';
}

$layout_classes = ' ' . $classes['padding_top'] . ' ' . $classes['padding_bottom'] . ' ';
?>

<section class="section-25 <?php print $layout_classes; ?> edit safe-mode nodrop" field="layout-skin-10-<?php print $params['id'] ?>" rel="module">
   <h1>ZDRAVO</h1>
</section>
