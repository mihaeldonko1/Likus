<?php
require_once(dirname(__FILE__) . DS . 'functions.php');

$id_skupine = get_option('id_skupine', $params['id']);
$text_galerije = get_option('text_galerije', $params['id']);

$items = getImages($id_skupine);
$vseSlike = "";
$naslovnaSlika = "";

try { 
    $vseSlike = $items['vseSlike'] ?? "";
    $naslovnaSlika = "http://localhost:1337" . ($items['naslovnaSlika'] ?? "");
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage();
}

?>

<style>
    #mainImage {
        width: 100%;
        padding: 10px; /* adjust the padding as needed */
        box-sizing: border-box;
    }

    #mainImage img {
        width: 100%; 
        height: auto;
    }
</style>

<?php
try {
    echo '<div id="mainImage"><a href="'.$naslovnaSlika.'" data-fancybox="gallery'.$id_skupine.'"><img src="'.$naslovnaSlika.'" alt="Main Image"></a>';
    echo '<div>'.$text_galerije.'</div></div>';

    if (is_array($vseSlike)) {
        foreach ($vseSlike as $slika) {
            $fullImageUrl = "http://localhost:1337" . $slika;
            echo '<a href="'.$fullImageUrl.'" data-fancybox="gallery'.$id_skupine.'" style="display:none;"><img src="'.$fullImageUrl.'" alt="Image"></a>';
        }
    }
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage();
}
?>

<script>
  $(document).ready(function() {
    $("[data-fancybox^='gallery']").fancybox({
      loop: true,
    });
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
