@extends('header')

<style>
    .card-img {
        height: 200px !important;
        width: 200px !important;
        object-fit: cover;
    }
#content {
  display: none;
}
#loader {
  background-color: white;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}
#loader-text {
  font-size: 32px;
  text-align: center;
  opacity: 0;
  animation: fade-out 6s ease-in-out forwards;
}
@keyframes fade-out {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>
<div id="loader">
    <h1 id="loader-text">Dobrodošli v spletni čitalnici Likusa</h1>
  </div>
  <div id="content">
        <div class="d-flex justify-content-center">
            <div class="pagination">
                <ul class="pagination">
                    <li class="page-item{{ ($members->currentPage() === 1) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $members->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    @php
                        $currentPage = $members->currentPage();
                        $lastPage = $members->lastPage();
                        $range = 2; // Number of pages to show before and after the current page
                        $startPage = max($currentPage - $range, 1);
                        $endPage = min($currentPage + $range, $lastPage);
                    @endphp

                    @if ($startPage > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $members->url(1) }}">1</a>
                        </li>
                        @if ($startPage > 2)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif
                    @endif

                    @foreach ($members->getUrlRange($startPage, $endPage) as $page => $url)
                        <li class="page-item{{ ($members->currentPage() === $page) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($endPage < $lastPage)
                        @if ($endPage < ($lastPage - 1))
                            <li class="page-item disabled">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $members->url($lastPage) }}">{{ $lastPage }}</a>
                        </li>
                    @endif

                    <li class="page-item{{ ($members->currentPage() === $members->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $members->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($members->items() as $item)
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-4">
                        <div class="card text-center">
                            @if (isset($item['attributes']['Profilna_slika']['data'][0]['attributes']['url']))
                                <img src="http://localhost:1337{{ $item['attributes']['Profilna_slika']['data'][0]['attributes']['url'] }}" class="card-img-top mx-auto d-block mt-3 card-img">
                            @else
                                <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block mt-3 card-img">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="clan/{{ $item['id'] }}">
                                        {{ $item['attributes']['Ime'] }} <br /> {{ $item['attributes']['Priimek'] }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>
<script>
// Wait for the page to load
window.addEventListener("load", function () {
  if (window.location.href === "http://127.0.0.1:8000/clani") {
    const loaderText = document.getElementById("loader-text");

    const textContent = loaderText.textContent;

    loaderText.textContent = "";

    let counter = 0;
    const timer = setInterval(function () {
      loaderText.textContent += textContent[counter];
      counter++;

      if (counter >= textContent.length) {
        clearInterval(timer);

        loaderText.addEventListener("animationend", function () {
          document.getElementById("loader").style.display = "none";
          document.getElementById("content").style.display = "block";
        });
      }
    }, 50); // Adjust the delay between each letter (in milliseconds)
  } else {
    document.getElementById("loader").style.display = "none";
    document.getElementById("content").style.display = "block";
  }
});



</script>
@extends('footer')
