<?php
if (isset($data['data']['attributes']['Zivljenjepis']['data']) && $data['data']['attributes']['Zivljenjepis']['data'] != null) {
    $zivljenjepisId = $data['data']['attributes']['Zivljenjepis']['data'][0]['attributes']['url'];
} else {
    $zivljenjepisId = 0;
}
?>
<?php
    use Carbon\Carbon;
    $birthday = Carbon::createFromFormat('Y-m-d', $data['data']['attributes']['Rojstni_dan']);
    $currentDate = Carbon::now();
    $yearsDifference = $birthday->diffInYears($currentDate);
?>
@extends('layouts.app')
@section('content')

<style>
    body {
        background-color: beige !important;
    }
    .custom-title {
        color:  #e89443;
        text-align: center;
        font-size: 30px;
    }

    .btn-close {
        font-size: 24px;
        padding: 10px 15px;
        background-color: #c24a64; 
        color: #fff; 
        border: none; 
    }

    .btn {
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    background-color: #e89443;
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn:hover .button-hover {
    opacity: 1;
    background-color: #fff;
}

.button-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    background-color: #fff;
    transition: opacity 0.3s;
    z-index: -1;
}

.button-text {
    position: relative;
    z-index: 1;
}

h1, h3, h2 {
color: #e89443;
} 

.style-hr {
    height: 12px;
    border: 0;
    box-shadow: inset 0 15px 15px -15px rgba(0, 0, 0, 0.5);
    width: 100vw;
    margin-left: calc(50% - 50vw);
}

.shadow {


    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.shadow_card{

    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.button-with-shadow {
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
}


</style>

<br>
<br>

<div class="container mt-4">
<div class="row text-center mb-5">
  <h1 style="font-size: 3.7em; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Informacije o članu:</h1>
</div>

<br>

    <div class="row">



    <div class="col-md-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center align-items-center">
                    @if (isset($data['data']['attributes']['Profilna_slika']['data']['attributes']['url']))
                        <img src="http://localhost:1337{{ $data['data']['attributes']['Profilna_slika']['data']['attributes']['url'] }}" style="width: 80%; margin-bottom: 10px; border-radius: 20px">
                    @else
                        <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" style="width: 80%; margin-bottom: 10px; border-radius: 20px">
                    @endif
                    </div>
                </div>
                
                <div class="col-md-12 text-center">
                    <div class="row">
                        <span style="font-size: 2.5em; color: #e89443;  margin-bottom: 2px; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">{{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}</span><br>
                        <span style="font-size: 1.2em;  margin-bottom: 2px">Datum rojstva: <i>{{ date('d-m-Y', strtotime($data['data']['attributes']['Rojstni_dan'])) }} </i></span>
                        <span style="font-size: 1.2em;  margin-bottom: 2px">Spol:  <i>{{ $data['data']['attributes']['Spol'] }} </i></span><br>
                        <span style="font-size: 1.2em;  margin-bottom: 2px">Starost:  <i>{{ $yearsDifference }} </i></span><br>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-7">
     @if(isset($data['data']['attributes']['Zivljenjepis']['data']))
        <div class="col-md-12">
            <div class="rounded p-3 shadow" style="background-color: white;">
            <h2>Življenjepis {{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}</h2><br>
                <div id="outputZivljenjepis"></div>
           
</div>
        </div>
    @else
        <div class="col-md-12">
            <div class="rounded p-3 shadow" style="background-color: white">
                <h2>Življenjepis {{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}</h2><br>
                <div class="missingZivljenjepis">Oseba še ni objavila življenjepisa, poskusite kasneje</div>
            </div>
        </div>
    @endif
    </div>
    </div>
    @if(isset($data['data']['attributes']['Rokopis']['data']))
    <br>
    <br>
    <br>
    
    <hr class="style-hr">
    <br>
    <div class="row">
        <div class="col-md-12 text-center">
        
            <h1 style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); font-size: 3em">Rokopis :</h1>
            <br>
            <br>
            <div id="rokopisContainer">
                <img src="http://localhost:1337{{ $data['data']['attributes']['Rokopis']['data'][0]['attributes']['url'] }}" style="width: 50%;">
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <hr class="style-hr">
    @endif
    @if(isset($data['data']['attributes']['clanki']['data'][0]))
        <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                <div class="modal-header" style="display: flex; justify-content: center; align-items: center;">
                    <h5 class="modal-title custom-title" id="exampleModalLabel">
                        {{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}<br />
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="body-book">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                
                <h1 style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); font-size: 3em">Članki :</h1>
                <br>
                <br>
            </div>
            @foreach($data['data']['attributes']['clanki']['data'] as $val)
            <div class="col-md-3 mb-4">
                <div class="card d-flex align-items-center justify-content-center shadow_card">
                    <div class="card-body text-center">
                        @if ($val['attributes']['Stevilka_knjige'] < 69)
                            <img src="/resources/img/icons/knjige/{{ $val['attributes']['Stevilka_knjige'] }}-knjiga.jpg" class="card-img-top mx-auto d-block mt-3 card-img" style="height:300px !important"> <br>
                        @else
                            <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block mt-3 card-img" style="height:300px !important"> <br>
                        @endif
                        <div>
                        <div>
                        <p class="card-text"> <i>Letnica knjige: {{ $val['attributes']['Letnica_zbornika'] }}</i></p>
                        <p class="card-text"><i>Številka knjige: {{ $val['attributes']['Stevilka_knjige'] }}</i></p>
                        <p style="margin-bottom: 20px;" class="card-text"><i>Strani v knjigi: {{ $val['attributes']['Strani_od'] }}-{{ $val['attributes']['Strani_do'] }}</i></p>
                        </div>
                        <div>
                        <button data-book="{{ $val['id'] }}" class="btn btn-primary bookLoader button-with-shadow" data-bs-toggle="modal" data-bs-target="#bookModal" style="margin-bottom: 20px;>
                        <span class="button-text">Preberi članek</span>
                        <span class="button-hover"></span>
                        </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if(isset($data['data']['attributes']['Dodatni_clanki']['data']))
    <hr class="style-hr">
    <div class="row">
    <h3>Dodatne objave člana</h3>
        @foreach($data['data']['attributes']['Dodatni_clanki']['data'] as $val)
        <div class="col-md-3 mb-4">
                <div class="card d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        <p class="card-text">Ime članka: <br /> {{ str_replace('.pdf', '', $val['attributes']['name']) }}</p>
                        <a class="btn btn-primary" href="http://localhost:1337{{$val['attributes']['url']}}" target="_blank">Preberi več</a>

                    </div>
                </div>
            </div>
        @endforeach
        </div>
        </div>  
    @endif
    </div>
                <br>
                <br>
                <br>
                
                

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script type="text/javascript" src="../resources/js/extras/jquery.min.1.7.js"></script>
    <script type="text/javascript" src="../resources/js/extras/modernizr.2.5.3.min.js"></script>
<script src="../resources/js/main.js"></script>
<script src="../resources/js/bookifyPDF.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="https://kit.fontawesome.com/b0f29e9bfe.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    var defaultContent = $('.body-book').html();

    $(".bookLoader").click(function() {
    $('.container-bookify').html(defaultContent);
    var bookValue = $(this).data("book");
    fetch(`http://localhost:1337/api/clanki/${bookValue}?populate=*`)
        .then(response => response.json())
        .then(data => {
            let uri = data.data.attributes.Clanek.data.attributes.url;
             let fullurl = "http://localhost:1337"+uri;        
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

            yepnope({
                test: Modernizr.csstransforms,
                yep: ['../resources/js/lib/turn.js'],
                nope: ['../resources/js/lib/turn.html4.min.js'],
                both: ['css/basic.css'],
                complete: function () {
                    renderPDF(fullurl, $(".flipbook")).then(loadApp).then(function () {
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
            });
//tu se konca book
        })
        .catch(error => {
            console.error(error);
        });
    });

    let zivljenjepisId = "http://localhost:1337<?php echo $zivljenjepisId; ?>";
    if (zivljenjepisId!=0) {
        odtConverter(zivljenjepisId);
    } else {
        document.getElementById('outputZivljenjepis').textContent = "Član žal še ni objavil svojega življenjepisa";
    }
});
</script>
@endsection