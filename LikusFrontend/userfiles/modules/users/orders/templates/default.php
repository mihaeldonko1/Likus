<div id="uploadClanek">
    <div class="infoText">
        <h4>Objavi samostojen članek</h4><br /><br />
        <h5>Na tej platformi imate priložnost objaviti svoj lasten članek, ki ni del urejanja zbornika Likusa. Tukaj je nekoliko podrobnejši vodič, kako to storiti:</h5><br /><br />
        <h5>Pripravite članek:</h5>
        <span>
            Pred objavo se prepričajte, da je vaš članek v skladu z našimi smernicami in standardi. Članek naj bo originalen, neobjavljen in ne del urejanja zbornika Likusa.
        </span><br /><br />
        <h5>Kako objaviti:</h5>
        <span>
            Ko je vaš članek pripravljen za objavo, ga preprosto povlečite ali naložite v spodnjo polje in kliknite objavi, da se objavi na naši spletni platformi
            <b>(Pazite da je članek v formatu PDF)</b>.
        </span><br /><br />
        <h5>Privolitev:</h5>
        <span>
            Z objavo vašega članka na naši spletni strani nam avtomatično dajete pravico, da ga prikažemo na naši spletni strani. To pomeni, da smo po objavi vašega članka pridobili dovoljenje, da ga lahko uporabljamo, prikazujemo in delimo na naši spletni strani.
        </span><br /><br />
        <h5>Objava:</h5>
        <span>
            Ko je vaš članek uspešno objavljen, bo na voljo za ogled na naši spletni strani. Upoštevajte, da v primeru neprimernih objav bo članek v skladu z našimi standardi in pravili izbrisan.
        </span><br /><br />
        <span>Upamo, da ta podrobnejša navodila olajšajo postopek objave. Veselimo se vašega prispevka!</span>
    </div>
    <form class="col-12 mb-5 mx-auto" method="post" id="pdf-data">
        <div style="margin-bottom: 10px; margin-top: 20px">
            <b><label style="margin-bottom: 10px;">Naložite vaš članek</label></b><br />
            <button class="btn btn-primary" onclick="handleButtonClick(event)">Naloži</button>
            <input type="file" id="pdfUpload" name="Clanek" style="display:none" accept=".pdf" onchange="displayFileName(this)">
            <span id="fileUploadedText" style="display:none;color: green">Datoteka uspešno naložena</span>
        </div>
    </form>
    <hr>
    <button type="button" class="btn btn-default btn-lg btn-block m-t-10" onclick="uploadPDFdata()">Objavi</button>
</div>
<script>
  function handleButtonClick(event) {
    event.preventDefault();
    document.getElementById('pdfUpload').click();
  }
</script>
<script>
  function uploadPDFdata() {
  let email = "<?php print $user['email']; ?>";
  fetch(`http://localhost:1337/api/clanis?filters[Email][$eq]=${email}`)
    .then(response => response.json())
    .then(responseData => {
      const mainId = responseData['data'][0]['id']; 
      var fileInput = document.querySelector('#pdfUpload');
      var file = fileInput.files[0];

      if (!file || file === null || file === undefined || file === "") {
        $('#uploadClanek').empty();
            var redHeading = $('<h3>').text('Vaš članek ni uspešno naložen, poskusite ponovno!');
            redHeading.css('color', 'red');
            redHeading.css('margin-bottom', '100px');
            $('#uploadClanek').append(redHeading);
        return;
      }

      // Check if file type is PDF
      if (file.type !== 'application/pdf') {
        $('#uploadClanek').empty();
            var redHeading = $('<h3>').text('Vaš članek ni uspešno naložen, tip datoteke ni pravilen!');
            redHeading.css('color', 'red');
            redHeading.css('margin-bottom', '100px');
            $('#uploadClanek').append(redHeading);
        return;
      }

      console.log(mainId);
      console.log(file);

      var formData = new FormData();
      formData.append('files.Clanek', file);
      formData.append('data', JSON.stringify({
        publishedAt: null, clan: {connect: [mainId]}
      }));

      fetch(`http://localhost:1337/api/dodatne-objave`, {
        method: 'POST',
        body: formData
      })
        .then(updatedResponse => updatedResponse.json())
        .then(updatedData => {
          console.log("success")
          $('#uploadClanek').empty();
          $('#uploadClanek').empty();
            var greenHeading = $('<h3>').html('Članek je uspešno objavljen v pregled administratorja, če je skladen z navodili, bo objavljen v najkrajšem možnem času. <br /><br /> Za objavo se vam zahvaljuje Likus!');
            greenHeading.css('color', 'green');
            greenHeading.css('margin-bottom', '100px');
            $('#uploadClanek').append(greenHeading);

            var image = $('<img>').attr('src', 'http://127.0.0.1:8000/userfiles/media/default/likus-logo-nobackground_3.png');
            image.css('width', '40%');
            $('#uploadClanek').append(image);
        })
        .catch(error => {
          console.error('Error:', error);
          $('#uploadClanek').empty();
          var redHeading = $('<h3>').text('Vaš članek ni uspešno naložen, poskusite ponovno!');
          redHeading.css('color', 'red');
          redHeading.css('margin-bottom', '100px');
          $('#uploadClanek').append(redHeading);
        });
    })
    .catch(error => {
      console.error('Error:', error);
      $('#uploadClanek').empty();
      var redHeading = $('<h3>').text('Vaš članek ni uspešno naložen, poskusite ponovno!');
      redHeading.css('color', 'red');
      redHeading.css('margin-bottom', '100px');
      $('#uploadClanek').append(redHeading);
    });
}


  function displayFileName(input) {
    var fileUploadedText = document.getElementById("fileUploadedText");
    if (input.value) {
      fileUploadedText.style.display = "inline";
    } else {
      fileUploadedText.style.display = "none";
    }
  }
</script>




