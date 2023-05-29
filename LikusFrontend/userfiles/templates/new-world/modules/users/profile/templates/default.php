<?php $user = get_user_by_id(user_id()); ?>
    <script>
        saveuserdata = function () {
            var data = mw.serializeFields('#user-data');
            if (data.password != data.password2) {
                mw.$('#errnotification').html('Passwords do not match').show();
                return false;
            } else {
                mw.$('#errnotification').hide();

                if (data.password == '') {
                    delete data.password;
                    delete data.password2;
                }
            }
            mw.tools.loading('#user-data')
            $.post("<?php print api_url(); ?>save_user", data, function () {
                mw.tools.loading('#user-data', false);
            });
        }
    </script>

    <form class="col-12 mb-5 mx-auto" method="post" id="user-data">
    <div class="my-3">
            <h5 class="mb-2"><?php _lang('Uredi profil', "templates/new-world"); ?></h5>
            <small class="text-muted d-block mb-2"><?php _lang('Tukaj lahko uredite vaš profil', "templates/new-world"); ?></small>
        </div>
        <div class="mw-ui-box mw-ui-box-important mw-ui-box-content" id="errnotification" style="display: none;margin-bottom: 12px;"></div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Uporabniško ime", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="username" value="<?php print $user['username']; ?>" placeholder="<?php _lang('Uporabniško ime', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Email", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="email" name="email" value="<?php print $user['email']; ?>" placeholder="<?php _lang('Email', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Ime", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="first_name" value="<?php print $user['first_name']; ?>" placeholder="<?php _lang('Ime', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Priimek", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="last_name" value="<?php print $user['last_name']; ?>" placeholder="<?php _lang('Priimek', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Naslov", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Naslov" value="<?php print $user['Naslov']; ?>" placeholder="<?php _lang('Naslov', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Pošta", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Posta" value="<?php print $user['Posta']; ?>" placeholder="<?php _lang('Pošta', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Poštna številka", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Postna_stevilka" value="<?php print $user['Postna_stevilka']; ?>" placeholder="<?php _lang('Poštna številka', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Država", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Drzava" value="<?php print $user['Drzava']; ?>" placeholder="<?php _lang('Država', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Telefon", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="phone" value="<?php print $user['phone']; ?>" placeholder="<?php _lang('Telefon', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Novo geslo", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="password" name="password" placeholder="<?php _lang('Novo geslo', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Potrdi geslo", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="password" name="password2" placeholder="<?php _lang('Potrdi geslo', "templates/new-world"); ?>">
        </div>
        
        <button type="button" class="btn btn-default btn-lg btn-block m-t-10" onclick="saveuserdata()"><?php _lang('Save', "templates/new-world"); ?></button>
    </form>

