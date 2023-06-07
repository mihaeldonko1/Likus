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
        mw.tools.loading('#user-data');
        $.post("<?php print api_url(); ?>save_user", data, function () {
            mw.tools.loading('#user-data', false);
            
            fetch(`http://localhost:1337/api/clanis?filters[Email][$eq]=${data.email}`)
                .then(response => response.json())
                .then(responseData => {
                    const mainId = responseData['data'][0]['id']; 
                    var fileInput = document.querySelector('#pictureUpload');
                    var fileInput1 = document.querySelector('#zivljenjepisUpload');
                    var file2 = fileInput1.files[0];
                    var file = fileInput.files[0];
                    var formData = new FormData();
                    formData.append('files.Zivljenjepis', file2);
                    formData.append('files.Profilna_slika', file);
                    formData.append('data', JSON.stringify({
                        Ime: data.first_name,
                        Priimek: data.last_name,
                        Drzava: data.Drzava,
                        Naslov: data.Naslov,
                        Posta: data.Posta,
                        Postna_stevilka: data.Postna_stevilka,
                        Telefon: data.phone
                    }));
                    fetch(`http://localhost:1337/api/clanis/${mainId}`, {
                    method: 'PUT',
                    body: formData
                    })
                    .then(updatedResponse => updatedResponse.json())
                    .then(updatedData => {
                        fetch(`http://localhost:1337/api/clanis/${mainId}?populate=*`)
                            .then(response => {
                                if (!response.ok) {
                                throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(profileData => { 
                                var profileURL = profileData['data']['attributes']['Profilna_slika']['data']['attributes']['url'];
                                data.Profilna = profileURL; 
                                console.log(data);
                                $.post("<?php print api_url(); ?>save_user", data, function () {
                                    mw.tools.loading('#user-data', false);
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }
</script>
<script>
document.getElementById('pictureUpload').addEventListener('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
        document.querySelector('label[for="pictureUpload"] img').src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
});
</script>
<script>
    var profileImage = document.getElementById("profileImage");
    profileImage.onerror = function() {
        profileImage.src = "https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg";
    };
</script>





    <form class="col-12 mb-5 mx-auto" method="post" id="user-data">
    <div class="my-3">
            <h5 class="mb-2 text-align center"><?php _lang('Uredi profil', "templates/new-world"); ?></h5>
            <small class="text-muted d-block mb-2 text-align center"><?php _lang('Tukaj lahko uredite vaš profil', "templates/new-world"); ?></small>
        </div>
        <div class="mw-ui-box mw-ui-box-important mw-ui-box-content" id="errnotification" style="display: none;margin-bottom: 12px;"></div>


        <div class="form-group mb-2 text-align center">
            <label for="pictureUpload">
                <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; display: inline-block; margin-right: 10px;">
                    <img  id="profileImage" src="http://localhost:1337<?php print $user['Profilna']; ?>" alt="test" style="cursor: pointer; width: 100%; height: 100%; object-fit: cover;">
                </div>
            </label>
        </div>
        <div class="form-group mb-2" style="display: none;">
            <label class="control-label mb-2"><?php _lang("Izberite sliko", "templates/new-world"); ?></label>
            <input class="form-control-file" type="file" name="profilna" id="pictureUpload" accept="image/*">
        </div>

        <div class="form-group mb-2 text-align center">
            <label class="control-label mb-2"><?php _lang("Posodobite življenjepis", "templates/new-world"); ?></label>
            <input style="margin-right: -75px;" class="form-control-file" type="file"  id="zivljenjepisUpload" accept="application/vnd.oasis.opendocument.text"> 
        </div>
        <br />

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Email :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="email" name="email" value="<?php print $user['email']; ?>" placeholder="<?php _lang('Email', "templates/new-world"); ?>" readonly>
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Ime :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="first_name" value="<?php print $user['first_name']; ?>" placeholder="<?php _lang('Ime', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Priimek :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="last_name" value="<?php print $user['last_name']; ?>" placeholder="<?php _lang('Priimek', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Naslov :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Naslov" value="<?php print $user['Naslov']; ?>" placeholder="<?php _lang('Naslov', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Pošta :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Posta" value="<?php print $user['Posta']; ?>" placeholder="<?php _lang('Pošta', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Poštna številka :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Postna_stevilka" value="<?php print $user['Postna_stevilka']; ?>" placeholder="<?php _lang('Poštna številka', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Država :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="Drzava" value="<?php print $user['Drzava']; ?>" placeholder="<?php _lang('Država', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Telefon :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="text" name="phone" value="<?php print $user['phone']; ?>" placeholder="<?php _lang('Telefon', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Novo geslo :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="password" name="password" placeholder="<?php _lang('Novo geslo', "templates/new-world"); ?>">
        </div>

        <div class="form-group mb-2">
            <label class="control-label mb-2"><?php _lang("Potrdi geslo :", "templates/new-world"); ?></label>
            <input class="form-control input-lg" type="password" name="password2" placeholder="<?php _lang('Potrdi geslo', "templates/new-world"); ?>">
        </div>
        <br />
        
        <div class="text-align center">
        <button type="button" class="btn btn-default btn-lg btn-block m-t-10" onclick="saveuserdata()"><?php _lang('Shrani nove podatke', "templates/new-world"); ?></button>
        </div>
    </form>

