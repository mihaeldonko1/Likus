<script src="https://kit.fontawesome.com/b0f29e9bfe.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js" integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js" integrity="sha512-lHibs5XrZL9hXP3Dhr/d2xJgPy91f2mhVAasrSbMkbmoTSm2Kz8DuSWszBLUg31v+BM6tSiHSqT72xwjaNvl0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
  * {
    margin: 0;
    padding: 0;
  }
  
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
  main {
    flex: 1;
  }
  
  footer {
    background-color: #333;
    color: #979aa6;
    padding: 27px;
  }

  footer p {
    margin: 0;
    padding: 3px 0; 
  }


  footer p.italic {
    font-style: italic;
    margin-top: 0px; 
  }

  .footer-logo {
  top: 5px;
  left: 5px;
  height: 75px;
  text-align: left;
  width: auto;
}

 .social_media_footer {
    text-align: right;
} 

  .sredina_footerja{

    color: #b6b6b6
  }

  .footer-container{
    padding-left: 28px;
    padding-right: 28px;

  }



</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<footer>
    <div class="footer-container"> 
      <div class="row">
        <div class="col-md-4 col-sm-12">
        <img src="/resources/img/random_slike/slps_sivo.png" alt="Logo" class="footer-logo">
        <img src="/resources/img/random_slike/likus_circle_logo.png" alt="Logo" class="footer-logo">
        <img src="/resources/img/random_slike/volcji_tabor_logo_BrezOzadja.png" alt="Logo" class="footer-logo">
        </div> 
        <div class="col-md-4 col-sm-12 sredina_footerja text-center">
          <p class="rights_reserved">&copy; All Rights Reserved &copy; - Likus.si</p>
          <p class="italic">Created by: <a href="#" id="mihaelLink">Mihael Donko</a>, Jan Volovšek</p>
        </div> 
        <div class="social_media_footer col-md-4 col-sm-12">
        <p style="color: white; font-size: 15px ;margin-bottom: 6px;">Socialna omrežja:</p>
        <a href="https://www.facebook.com/people/LIKUS-Literarni-klub-upokojencev-Slovenije/100063764491636/?locale=fr_FR" target="_blank"><i class="fab fa-facebook fa-2x" style="color: white; margin-right: 10px;"></i></a>
        <a href="https://www.youtube.com/channel/UCGy5CJ-UeHQQgHs7hljvoMg" target="_blank"><i class="fab fa-youtube fa-2x" style="color: white; margin-right: 10px;"></i></a>
        <a href="https://www.instagram.com/your-instagram-profile" target="_blank"><i class="fab fa-instagram fa-2x" style="color: white;"></i></a>
        </div>
      </div>    
    </div>
  </footer>

  <div class="modal fade" id="mihaelModal" tabindex="-1" role="dialog" aria-labelledby="mihaelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mihaelModalLabel">Mihael Donko</h5>
          <button id="closeButton" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body">
            <p>Dobrodošli na Projektu Likus.si!</p>
            <p>Projekt Likus.si je bil ustvarjen kot del programa Informatika na Univerzi v Mariboru, Fakulteti za elektrotehniko, računalništvo in informatiko (FERI). Razvil sem ga v okviru prostovoljne pogodbe s podjetjem Likus.</p>
            <p>Ime mi je Mihael Donko in sem spletni razvijalec iz Maribora, Slovenije, rojen leta 2002. V industriji delam že od leta 2021 in sem specializiran za razvoj spletnih trgovin ter samostojnih projektov. Moj glavni Skillset je ogrodje(framework) Laravel, ki je bil tudi uporabljen za izgradnjo te spletne strani.</p>
            <p>Vedno sem pripravljen sprejeti nova dela, zato me lahko kontaktirate preko elektronske pošte: <a href="mailto:miha.donko@gmail.com">miha.donko@gmail.com</a> ali pa me lahko najdete na <a href="https://www.linkedin.com/in/mihael-donko-50b292281/">LinkedIn</a> in na <a href="https://www.facebook.com/miha.donko/">Facebooku</a>.</p>
        </div>

      </div>
    </div>
  </div>


  <script>
    document.getElementById('mihaelLink').addEventListener('click', function(event) {
      event.preventDefault(); 
      $('#mihaelModal').modal('show');
    });
  </script>
<?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\resources\views/layouts/footer.blade.php ENDPATH**/ ?>