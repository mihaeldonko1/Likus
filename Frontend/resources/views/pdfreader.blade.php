@extends('layouts.app')
    @section('content')
        <?php
            $pdfArray = array_column($filteredData, 'pdf');
            $jsonPdfArray = json_encode($pdfArray);
        ?>
                                    <button class="prevChapter">Prejšnji članek</button>
                            <button class="nextChapter">Naslednji članek</button>
                        <div class="container-bookify">

                            <div class="book-body">
                                <button class="button-book" id="prev-btn">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </button>
                                <div id="book" class="book"></div>
                                <button class="button-book" id="next-btn">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>

<script src="../resources/js/main.js"></script>
<script src="../resources/js/bookifyPDF.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="https://kit.fontawesome.com/b0f29e9bfe.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    var allPDFs = JSON.parse('<?php echo $jsonPdfArray; ?>');
    var defaultContent = $('.container-bookify').html();
    var currentChapter = 0; 

    function loadChapter(index) {
        var url = allPDFs[index]; 
        $('.container-bookify').html(defaultContent);
        readPDFasBook(url, "prev-btn", "next-btn", "book", 1);
    }

    loadChapter(currentChapter);

    $(".nextChapter").click(function() {
        currentChapter++; 
        if (currentChapter >= allPDFs.length) {
            alert("Ste na koncu knjige.");
            currentChapter = allPDFs.length - 1; 
            return;
        }
        loadChapter(currentChapter);
    });

    $(".prevChapter").click(function() {
        currentChapter--; 
        if (currentChapter < 0) {
            alert("Ste nja začetku knjige.");
            currentChapter = 0; 
            return;
        }
        loadChapter(currentChapter);
    });
});
</script>

@endsection 