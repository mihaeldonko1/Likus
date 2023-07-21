<?php
$autoloadPath = base_path('vendor/autoload.php');
require_once $autoloadPath;
require_once(dirname(__FILE__) . DS . 'functions.php');

$likus_api_urlMain = config('likusConfig.likus_api_urlMain');

$id_skupine = get_option('id_natecaja', $params['id']);
$text_natecaja = get_option('text_natecaja', $params['id']);

$items = getNatecaji($id_skupine);

try{
    $natecaj_url = $likus_api_urlMain.$items['data']['attributes']['Pdf_natecaja']['data']['attributes']['url'];
    } catch (Exception $e) {
     $natecaj_url = $e;
    }
$uniqueID = uniqid();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.min.js" integrity="sha512-9Wd08apcJEwm8g3lBTg1UW/njdN0iuuOVWKpyinK3uA7ISAE5PmEZ4y8bZYTXVOE3tlt7aFlCBBLmLt5cUxe2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
  <span><?php echo $text_natecaja; ?></span>
  <a href="<?php echo $natecaj_url; ?>">Preberi podrobno</a>
  <div>
    <button id="prev<?php echo $uniqueID; ?>">Previous</button>
    <span id="page_status<?php echo $uniqueID; ?>"></span>
    <button id="next<?php echo $uniqueID; ?>">Next</button>
  </div>
</div>

<div style="width:100%; height:500px; position: relative; display: flex; align-items: center; justify-content: center;">
  <canvas id="the-canvas<?php echo $uniqueID; ?>" style="max-width: 100%; max-height: 100%;"></canvas>
</div>


<script>
(function() {
  var url = <?php echo json_encode($natecaj_url); ?>;
  var text_natecaja = <?php echo json_encode($text_natecaja); ?>;
  var uniqueID = <?php echo json_encode($uniqueID); ?>;

  var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      canvas = document.getElementById('the-canvas' + uniqueID),
      ctx = canvas.getContext('2d'),
      parentDiv = canvas.parentElement,
      parentWidth = parentDiv.clientWidth,
      parentHeight = parentDiv.clientHeight;

  function renderPage(num) {
    pageRendering = true;

    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport({scale: 1});
      var scale = Math.min(parentWidth / viewport.width, parentHeight / viewport.height);
      viewport = page.getViewport({scale: scale});

      canvas.height = viewport.height;
      canvas.width = viewport.width;

      var renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };
      var renderTask = page.render(renderContext);

      renderTask.promise.then(function() {
        pageRendering = false;
        if (pageNumPending !== null) {
          renderPage(pageNumPending);
          pageNumPending = null;
        }
      });
    });

    document.getElementById('page_status' + uniqueID).textContent = num + '/' + pdfDoc.numPages;
  }

  function queueRenderPage(num) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num);
    }
  }

  document.getElementById('prev' + uniqueID).addEventListener('click', function() {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum);
  });

  document.getElementById('next' + uniqueID).addEventListener('click', function() {
    if (pageNum >= pdfDoc.numPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum);
  });

  pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    renderPage(pageNum);
  });

  console.log(text_natecaja);
})();
</script>