<?php

/*

type: layout

name: Default

description: Default register template

*/

?>
<?php if (is_logged() == false): ?>
    <script type="text/javascript">
        mw.moduleCSS("<?php print modules_url(); ?>users/users_modules.css");
        mw.require('forms.js', true);
        mw.require('url.js', true);
        $(document).ready(function () {
            mw.$('#user_registration_form_holder').submit(function () {
                mw.form.post(mw.$('#user_registration_form_holder'), '<?php print site_url('api') ?>/user_register', function () {
                    mw.response('#register_form_holder', this);
                    if (this.success) {
                        mw.reload_module('users/register');
                        window.location.href = window.location.href;
                    }
                });
                return false;
            });
        });
    </script>

    <div id="register_form_holder">
        <h4  class="text-center pt-3">
            <?php _e('Register new account.'); ?>
        </h4>
        <p class="text-center pb-4"><?php _e('We are glad to welcome you in our community.'); ?></p>
        <form class="p-t-10" action="#" id="user_registration_form_holder" method="post">
            <?php print csrf_form(); ?>
            <div class="form-group">
                    <label class="control-label"><?php _e('Ime'); ?></label>
                    <input class="form-control input-lg" type="text" name="first_name" placeholder="<?php _e('Ime'); ?>">
                </div>


                <div class="form-group">
                    <label class="control-label"><?php _e('Priimek'); ?></label>
                    <input class="form-control input-lg" type="text" name="last_name" placeholder="<?php _e('Priimek'); ?>">
                </div>


                <div class="form-group">
                    <label class="control-label"><?php _e('E-mail'); ?></label>
                    <input class="form-control input-lg" type="email" name="email" placeholder="<?php _e('E-mail'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Izberite tip spola'); ?></label>
                    <div>
                        <input type="radio" id="option3" name="Spol" value="Moški">
                        <label for="option3"><?php _e('Moški'); ?></label>
                    </div>
                    <div>
                        <input type="radio" id="option4" name="Spol" value="Ženski">
                        <label for="option4"><?php _e('Ženski'); ?></label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Datum rojstva'); ?></label>
                    <input class="form-control input-lg" type="date" name="Rojstni_dan" placeholder="<?php _e('Datum rojstva'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Telefon'); ?></label>
                    <input class="form-control input-lg" type="text" name="phone" placeholder="<?php _e('Telefon'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Naslov'); ?></label>
                    <input class="form-control input-lg" type="text" name="Naslov" placeholder="<?php _e('Naslov'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Pošta'); ?></label>
                    <input class="form-control input-lg" type="text" name="Posta" placeholder="<?php _e('Pošta'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Poštna številka'); ?></label>
                    <input class="form-control input-lg" type="text" name="Postna_stevilka" placeholder="<?php _e('Poštna številka'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Država'); ?></label>
                    <input class="form-control input-lg" type="text" name="Drzava" placeholder="<?php _e('Država'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php _e('Izberite tip članarine'); ?></label>
                    <div>
                        <input type="radio" id="option1" name="Tip_clana" value="LIKUS">
                        <label for="option1"><?php _e('LIKUS'); ?></label>
                    </div><br />
                    <div>
                        <input type="radio" id="option2" name="Tip_clana" value="SLPS">
                        <label for="option2"><?php _e('SLPS'); ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php _e('Geslo'); ?></label>
                    <input class="form-control input-lg" type="password" name="password" placeholder="<?php _e('Geslo'); ?>">
                </div>

            <?php if ($form_show_password_confirmation): ?>
                <div class="form-group">
                    <label class="control-label"><?php _e('Confirm Password'); ?></label>
                    <input class="form-control input-lg" type="password" name="password2" placeholder="<?php _e("Confirm Password"); ?>">
                </div>
            <?php endif; ?>

            <?php if (!$captcha_disabled): ?>
                <label class="control-label"><?php _e('Security code'); ?></label>
                <module type="captcha"/>
            <?php endif; ?>


            <div class="row">
                <div class="col-12">
                    <p class="personal-data"><?php _e("Your personal data will be used to support your expirience
                        throughout this website, to manage access to your account
                        and for other purposes described in our"); ?> <a href="#"><?php _e("privacy policy"); ?></a>.</p>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-primary btn-lg btn-block my-3 text-center justify-content-center"><?php print $form_btn_title ?></button>
        </form>
    </div>
<?php else: ?>
    <p class="text-center">
        <?php _e("You Are Logged In"); ?>
    </p>
<?php endif; ?>
<br/>