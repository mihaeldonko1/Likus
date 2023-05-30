@extends('layouts.app')
@section('content')

<style>
    body {
        background-color: beige;
    }

    .card {
        transition: transform 0.3s;
        cursor: pointer;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title a {
        transition: color 0.3s;
        color: #5e5e5e;
        text-decoration: none;
    }

    .card:hover .card-title a {
        color: #6ca7cc;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 5px;
        list-style-type: none;
    }

    .pagination .page-link {
        display: inline-block;
        padding: 10px 16px; 
        font-size: 16px; 
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #6ca7cc;
    }

    .pagination .page-item.active .page-link {
        background-color: #6ca7cc;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        pointer-events: none;
        background-color: #f2f2f2;
    }
</style>

<div id="loader" style="background-color: beige;">
    <h1 id="loader-text" style="font-size: 32px; font-family: 'Lato', sans-serif;">Dobrodošli v spletni čitalnici Likusa</h1>
</div>

<div id="content" style="display: none;">
    <div class="container">
        <div class="form-control" style="position: relative;">
            <div class="input-group" style="display: flex; align-items: stretch;">
                <input type="text" id="search" placeholder="Search" style="flex-grow: 1; padding: 10px; border: 1px solid #ccc; border-right: none; outline: none;">
                <select class="custom-select" id="selectType" style="border: 1px solid #ccc; border-left: none; padding: 10px; width: auto; outline: none;">
                    <option selected>Išči po</option>
                    <option value="Ime">Imenu</option>
                    <option value="Priimek">Priimku</option>
                </select>
                <button class="btn btn-primary" style="border: 1px solid #ccc; padding: 10px; margin-left: 5px;" id="searchButton">Iskanje</button>
            </div>
        </div>
        <div class="clearData mt-3" style="align-items: center">
            <button class="btn btn-secondary" style="margin-left: 5px;display: none" id="clearButton">Briši filter</button>
        </div>
    </div>
    <div class="d-flex justify-content-center">
    <div class="pagination" id="pages">
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

    <br>
    <br>
    <div class="container">
        <div class="row" id="membersContainer">
            <!-- Members will be dynamically populated here -->
        </div>
    </div>
    <div class="container" id="container_maincard">
        <div class="row">
            @foreach ($members->items() as $item)
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-4">
                    <div class="card text-center" onclick="location.href='clan/{{ $item['id'] }}';">
                        @if (isset($item['attributes']['Profilna_slika']['data']['attributes']['url']))
                            <img src="http://localhost:1337{{ $item['attributes']['Profilna_slika']['data']['attributes']['url'] }}" class="card-img-top mx-auto d-block mt-3 card-img">
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
                    setTimeout(function () { 
                        document.getElementById("loader").style.display = "none";
                        document.getElementById("content").style.display = "block";
                    }, 1500); 
                }
            }, 50); 
        } else {
            document.getElementById("loader").style.display = "none";
            document.getElementById("content").style.display = "block";
        }
    });
</script>
<script>
function generateMemberCards(responseData) {
  var members = responseData.data;
  var container = document.getElementById("membersContainer");
  container.innerHTML = "";

  if (!Array.isArray(members)) {
    console.log("Invalid data format received");
    console.log(members);
    return;
  }

  members.forEach(function (member) {
    var item = member.attributes;
    
    if (!item) {
        console.error('Member does not have attributes:', member);
        return;
    }

    var col = document.createElement("div");
    col.className = "col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-4";

    var card = document.createElement("div");
    card.className = "card text-center";
    card.onclick = function () {
      location.href = "clan/" + member.id;
    };

    // Profile picture
    var img = document.createElement("img");
    img.className = "card-img-top mx-auto d-block mt-3 card-img";

    var profileImageUrl = "https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg";

    if (
      item.Profilna_slika &&
      item.Profilna_slika.data &&
      item.Profilna_slika.data[0] &&
      item.Profilna_slika.data[0].attributes &&
      item.Profilna_slika.data[0].attributes.url
    ) {
      profileImageUrl = "http://localhost:1337" + item.Profilna_slika.data[0].attributes.url;
    }

    img.src = profileImageUrl;
    card.appendChild(img);

    var cardBody = document.createElement("div");
    cardBody.className = "card-body";

    var cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    var cardTitleLink = document.createElement("a");
    cardTitleLink.href = "clan/" + member.id;
    cardTitleLink.textContent = item.Ime + " " + item.Priimek;

    cardTitle.appendChild(cardTitleLink);
    cardBody.appendChild(cardTitle);
    card.appendChild(cardBody);
    col.appendChild(card);
    container.appendChild(col);
});

  document.getElementById("container_maincard").style.display = "none";
  document.getElementById("pages").style.display = "none";
  document.getElementById("clearButton").style.display = "block";
}

document.getElementById("clearButton").addEventListener("click", function () {
  document.getElementById("search").value = "";
  document.getElementById("membersContainer").innerHTML = "";
  document.getElementById("pages").style.display = "block";
  document.getElementById("clearButton").style.display = "none";
  document.getElementById("container_maincard").style.display = "block";
});


    function fetchMembers() {
        var search = document.getElementById("search").value;
        var selectType = document.getElementById("selectType").value;
        if (search && selectType) {
            fetch(`http://localhost:1337/api/clanis?filters[${selectType}][$contains]=${search}&populate=*`)
                .then(response => {
                    if (!response.ok) {
                        alert('Prosim izberite tip iskanja!');
                    }
                    return response.json();
                })
                .then(data => {
                    generateMemberCards(data);
                })
                .catch(error => {
                    console.log(error);
                });
        } else {
            alert('Prosim vpišite znake za iskanje!');
        }
    }

    document.getElementById("searchButton").addEventListener("click", fetchMembers);
</script>

@endsection
