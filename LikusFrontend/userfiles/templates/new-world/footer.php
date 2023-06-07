<style>

footer {
      background-color: #333;
      color: #fff;
      padding: 35px;
      text-align: center;
      font-size: 25px;
      font-family: Arial, sans-serif;
    }

    footer p.italic {
      font-style: italic;
      margin-top: -2px; 
    } 




</style>




<?php if ($footer == 'true'): ?>


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
    color: #b6b6b6 !important;
    font-size: 16px;
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


</style>

<footer>
  <div class="container"> 
    <div class="row">
      <div class="col-md-4 col-sm-12 text-left">
      <img src="/resources/img/random_slike/slps_sivo.png" alt="Logo" class="footer-logo">
        <img src="/resources/img/random_slike/likus_circle_logo.png" alt="Logo" class="footer-logo">
        <img src="/resources/img/random_slike/volcji_tabor_logo_BrezOzadja.png" alt="Logo" class="footer-logo">
      </div> 
      <div class="col-md-4 col-sm-12 text-center sredina_footerja">
        <p class="rights_reserved">&copy; All Rights Reserved &copy; - Likus.si</p>
        <p class="italic">Created by: Mihael Donko, Jan Volovšek,
           Miha Horvat</p>
      </div> 
      <div class="social_media_footer col-md-4 col-sm-12 ">
        <p style="color: white !important; font-size: 15px ;margin-bottom: 6px;">Socialna omrežja:</p>
        <a href="https://www.facebook.com/people/LIKUS-Literarni-klub-upokojencev-Slovenije/100063764491636/?locale=fr_FR" target="_blank"><i class="fab fa-facebook fa-2x" style="color: white; margin-right: 10px;"></i></a>
        <a href="https://www.youtube.com/channel/UCGy5CJ-UeHQQgHs7hljvoMg" target="_blank"><i class="fab fa-youtube fa-2x" style="color: white; margin-right: 10px;"></i></a>
        <a href="https://www.instagram.com/your-instagram-profile" target="_blank"><i class="fab fa-instagram fa-2x" style="color: white;"></i></a>
      </div>
    </div>    
  </div>
</footer>


    <div class="bg-pines d-block d-lg-none bg-default" style="height: 50px;"></div>
<?php endif; ?>

</div>

<button id="to-top" class="btn" style="display: block;"></button>

<?php include('footer_cart.php'); ?>


<script>
    mw.lib.require('slick');
</script>
<script>

    $(document).ready(function () {


        $('.navigation .menu .list.menu-root').collapseNav({
            responsive: 1,
            mobile_break: 992,
            more_text: '<?php _ejs("More"); ?>',
            li_class: 'has-sub-menu dropdown'
        });


        if ($(window).width() <= 991) {
            $('.navigation .menu .list.menu-root .has-sub-menu a.dropdown-toggle').attr('href', 'javascript:;');
            $('.navigation .menu .list.menu-root .has-sub-menu').on('click', function (e) {
                // e.preventDefault();
            })
        }
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        })
    });
</script>

<script src="<?php print template_url(); ?>assets/js/main.js"></script>
</body>
</html>
