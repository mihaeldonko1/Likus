<script>
    function mw_delete_shop_order(pid, iscart, e){
        if(e)e.preventDefault();
        var iscart = iscart || false;

        var r = confirm("<?php _ejs("Are you sure you want to delete this order"); ?>?");
        if (r == true) {
            $.post("<?php print api_url('delete_order') ?>", { id: pid,is_cart:iscart}, function(data) {
                window.location = window.location;
            });
        }
    }
</script><?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\Frontend\src\MicroweberPackages\Order/resources/views/admin/orders/partials/javascripts.blade.php ENDPATH**/ ?>