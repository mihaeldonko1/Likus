

<?php $__env->startSection('content'); ?>
    <?php
    $pdfArray = array_column($filteredData, 'pdf');
    $jsonPdfArray = json_encode($pdfArray);
    ?>


<style>

.custom-button {
        display: block; 
        width: 45%; 
        display: inline-block;
        padding: 10px 20px;
        background-color: #e89443;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
        border: none; 
        border-radius: 5px; 
    }

    .custom-button:hover {
        background-color: #c9721e;
        color: black;
    }


</style>

<div class="container">
    <div class="row text-center">
        <div class="col-md-6"><br>
            <button class="prevChapter custom-button"><   Prejšnji članek</button>
        </div>

        <div class="col-md-6"><br>
            <button class="nextChapter custom-button">Naslednji članek   ></button>
        </div>
    </div>
    <br>
</div>

    <div class="body-book container-bookify">
        <div class="flipbook-container">
            <div class="flipbook-viewport">
                <div class="container">
                    <div class="flipbook"></div>
                </div>
            </div>

            <div class="button-container">
                <button id="prev" class="flipbook-button">&#8249;</button>
                <button id="next" class="flipbook-button">&#8250;</button>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="../resources/js/lib/turn.js"></script>
    <script type="text/javascript" src="../resources/js/extras/modernizr.2.5.3.min.js"></script>
    <script>
        $(document).ready(function() {
            var allPDFs = <?php echo $jsonPdfArray; ?>;
            var defaultContent = $('.container-bookify').html();
            var currentChapter = 0;

            function loadChapter(index) {
                var url = allPDFs[index];
                $('.container-bookify').html(defaultContent);
                generateBook(url);
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

        function generateBook(url) {
            var bookUrl = url;
            var flipBookWidth = 1080;
            var flipBookHeight = 703;
            const flipBookWidthFinal = 1080;

            if (window.innerWidth < 1000) {
                if (window.innerWidth < flipBookWidthFinal / 2) {
                    flipBookWidth = window.innerWidth;
                } else {
                    flipBookWidth = flipBookWidth / 2;
                }
            }

            function renderPDF(url, canvasContainer, options) {
                var options = options || { scale: 1 };

                function renderPage(page) {
                    var viewport = page.getViewport({ scale: 1 });
                    var scale = Math.min(flipBookWidth / viewport.width, flipBookHeight / viewport.height);
                    viewport = page.getViewport({ scale: scale });
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');
                    var renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };

                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var pageDiv = document.createElement('div');
                    pageDiv.appendChild(canvas);
                    canvasContainer.append(pageDiv);

                    return page.render(renderContext).promise;
                }

                function renderPages(pdfDoc) {
                    var pages = [];
                    for (var num = 1; num <= pdfDoc.numPages; num++) {
                        pages.push(pdfDoc.getPage(num).then(renderPage));
                    }
                    return Promise.all(pages);
                }

                return pdfjsLib.getDocument(url).promise.then(renderPages);
            }

            function loadApp() {
                var display = window.innerWidth < 1000 ? 'single' : 'double';
                $('.flipbook').turn({
                    width: flipBookWidth,
                    height: flipBookHeight,
                    elevation: 50,
                    gradients: true,
                    display: display,
                    autoCenter: true
                });
            }

            renderPDF(bookUrl, $(".flipbook")).then(loadApp).then(function () {
                $('#next').click(function () {
                    $('.flipbook').turn('next');
                });

                $('#prev').click(function () {
                    $('.flipbook').turn('previous');
                });

                $(document).keydown(function (e) {
                    if (e.keyCode == 37) {
                        $('.flipbook').turn('previous');
                    } else if (e.keyCode == 39) {
                        $('.flipbook').turn('next');
                    }
                });
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\LikusFrontend\resources\views/pdfReader.blade.php ENDPATH**/ ?>