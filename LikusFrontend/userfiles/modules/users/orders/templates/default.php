<div id="uploadClanek">
    <div class="infoText text-align center">
        <h4>Objavi samostojen članek</h4><br /><br />
        <h5>Na tej platformi imate priložnost objaviti svoj lasten članek, ki ni del urejanja zbornika Likusa. Tukaj je nekoliko podrobnejši vodič, kako to storiti:</h5><br /><br />
        <h5>Pripravite članek :</h5><br />
        <span>
            Pred objavo se prepričajte, da je vaš članek v skladu z našimi smernicami in standardi. Članek naj bo originalen, neobjavljen in ne del urejanja zbornika Likusa.
        </span><br /><br />
        <h5>Kako objaviti :</h5><br />
        <span>
            Ko je vaš članek pripravljen za objavo, ga preprosto povlečite ali naložite v spodnjo polje in kliknite objavi, da se objavi na naši spletni platformi
            <b>(Pazite da je članek v formatu PDF)</b>.
        </span><br /><br />
        <h5>Privolitev :</h5><br />
        <span>
            Z objavo vašega članka na naši spletni strani nam avtomatično dajete pravico, da ga prikažemo na naši spletni strani. To pomeni, da smo po objavi vašega članka pridobili dovoljenje, da ga lahko uporabljamo, prikazujemo in delimo na naši spletni strani.
        </span><br /><br />
        <h5>Objava :</h5><br />
        <span>
            Ko je vaš članek uspešno objavljen, bo na voljo za ogled na naši spletni strani. Upoštevajte, da v primeru neprimernih objav bo članek v skladu z našimi standardi in pravili izbrisan.
        </span><br /><br />
        <span>Upamo, da ta podrobnejša navodila olajšajo postopek objave. Veselimo se vašega prispevka!</span>
    </div>
    <div class="text-align center">
    <form class="col-12 mb-5 mx-auto" method="post" id="pdf-data">
        <div style="margin-bottom: 10px; margin-top: 20px">
            <br><label style="margin-bottom: 10px; font-size: 18px;">Izberite natečaj</label></br>
            <select class="natecajCombo">
                <option value="null">Ne želim sodelovati v natečaju.</option>
            </select>
        </div>
        <div style="margin-bottom: 10px; margin-top: 20px">
        <br><label style="margin-bottom: 10px; font-size: 18px;">Naložite vaš članek</label></br>

            <button class="btn btn-primary" onclick="handleButtonClick(event)" style="width: 200px;">Naloži</button>
            <input type="file" id="pdfUpload" name="Clanek" style="display:none" accept=".pdf" onchange="displayFileName(this)">
            <span id="fileUploadedText" style="display:none;color: green">Datoteka uspešno naložena</span>
        </div>
    </form>
    </div>
    <hr>
    <div class ="text-align center">
    <button type="button" style="width: 200px;" class="btn btn-default btn-lg btn-block m-t-10" onclick="uploadPDFdata()">Objavi</button>
</div>
</div>
<script>
  function handleButtonClick(event) {
    event.preventDefault();
    document.getElementById('pdfUpload').click();
  }




  $(document).ready(function() {
  fetch('http://localhost:1337/api/natecaji')
    .then(response => {
      if (!response.ok) {
        throw new Error("HTTP status " + response.status);
      }
      return response.json();
    })
    .then(result => {
      let data = result.data;  // Use the 'data' property of the returned object

      if (Array.isArray(data)) {
        data.forEach(item => {
          if (item && item.hasOwnProperty('id') && item.attributes.hasOwnProperty('Ime')) {
            var option = $('<option>', {
              value: item.id,
              text: item.attributes.Ime  // Adjusted to access 'Ime' property inside 'attributes'
            });
            $('.natecajCombo').append(option);
          }
        });
      } else {
        throw new Error("Returned 'data' is not an array");
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
});



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

      let selectElement = document.querySelector('.natecajCombo');
      let selectedValue = selectElement.value;

        console.log(selectedValue + "izbran select");

        var formData = new FormData();
        formData.append('files.Clanek', file);
        var data = {
          publishedAt: null,
          clan: {connect: [mainId]}
        };

        if (selectedValue !== "null") {
          data.natecaj = {connect: [selectedValue]};
        }

        formData.append('data', JSON.stringify(data));


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




