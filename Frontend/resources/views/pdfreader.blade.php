@extends('header')


<style>
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    #pdf-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f7f7f7;
      perspective: 800px;
    }
    canvas {
      display: block;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.1s ease-in-out;
      transform-origin: left center;
    }
    #prev,
    #next {
      position: absolute;
      width: 70px;
      height: 70px;
      border: none;
      background-color: #f7f7f7;
      color: #333;
      font-size: 50px;
      cursor: pointer;
      z-index: 1;
      top: calc(50% - 40px);
    }
    #prev::before,
    #next::before {
      content: "";
      display: block;
      width: 0;
      height: 0;
      border-top: 25px solid transparent;
      border-bottom: 25px solid transparent;
    }
    #prev::before {
      border-right: 25px solid #606060;
      margin-left: 30px;
    }
    #next::before {
      border-left: 25px solid #606060;
      margin-right: 30px;
    }
    #prev {
      left: 445px;
    }
    #next {
      right: 442px;
    }
    #pdf-container.animate-next {
      transform: rotateY(-10deg);
    }
    #pdf-container.animate-prev {
      transform: rotateY(10deg);
    }
  </style>
</head>
<body>
  <button id="prev"></button>
  <button id="next"></button>
  <div id="pdf-container"></div>

  <!-- Add the script tags for pdf.js and pdf.worker.js
  <script src="pdf.min.js"></script>
  <script>
    // Initialize the PDFJS worker
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'pdf.worker.min.js';
  </script>
  <script src="script.js"></script>

 -->

 <script>
document.addEventListener('DOMContentLoaded', function() {
  const url = 'public/022500015-185188-JermanJanka.pdf';
  const pdfContainer = document.getElementById('pdf-container');
  let currentPage = 1; // Current page number
  let isAnimating = false; // Animation flag
  let pdfDoc = null; // Reference to the PDF document
  let pages = new Map(); 

  // Load and render the PDF document
  pdfjsLib.getDocument(url).promise.then(function(doc) {
    pdfDoc = doc;
    renderPage(currentPage);
    addEventListeners();
  });

  // Function to render a specific page of the PDF document
  function renderPage(pageNum) {
    if (pages.has(pageNum)) {
      // Page already rendered, retrieve from cache
      const canvas = pages.get(pageNum);
      pdfContainer.innerHTML = '';
      pdfContainer.appendChild(canvas);
    } else {
      // Page not rendered, load and render
      pdfDoc.getPage(pageNum).then(function(page) {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        // Set the desired scale and dimensions for the PDF page
        const scale = 0.8; // Adjust as needed
        const viewport = page.getViewport({ scale });

        // Adjust canvas size based on viewport dimensions
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        const renderContext = {
          canvasContext: context,
          viewport
        };

     
        page.render(renderContext).promise.then(function() {
      
          pages.set(pageNum, canvas);

          if (pageNum === currentPage) {
            pdfContainer.innerHTML = '';
            pdfContainer.appendChild(canvas);
          }
        });
      });
    }
  }

  
  function nextPage() {
    if (!isAnimating && currentPage < pdfDoc.numPages) {
      isAnimating = true;
      currentPage++;
      pdfContainer.classList.add('animate-next');

      setTimeout(function() {
        renderPage(currentPage);
        pdfContainer.classList.remove('animate-next');
        isAnimating = false;
      }, 100); 
    }
  }


  function prevPage() {
    if (!isAnimating && currentPage > 1) {
      isAnimating = true;
      currentPage--;
      pdfContainer.classList.add('animate-prev');

      setTimeout(function() {
        renderPage(currentPage);
        pdfContainer.classList.remove('animate-prev');
        isAnimating = false;
      }, 100);
    }
  }

  
  function addEventListeners() {
   
    document.getElementById('next').addEventListener('click', function() {
      if (!isAnimating && currentPage < pdfDoc.numPages) {
        nextPage();
      }
    });

    
    document.getElementById('prev').addEventListener('click', function() {
      if (!isAnimating && currentPage > 1) {
        prevPage();
      }
    });
  }
});




 </script>




@extends('footer')