<?php
if (isset($data['data']['attributes']['Zivljenjepis']['data']) && $data['data']['attributes']['Zivljenjepis']['data'] != null) {
    $zivljenjepisId = $data['data']['attributes']['Zivljenjepis']['data'][0]['attributes']['url'];
} else {
    $zivljenjepisId = 0;
}
?>
@extends('layouts.app')
@section('content')

<style>
    body {
        background-color: beige;
    }
    .custom-title {
        color: #6ca7cc;
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
    background-color: #6ca7cc;
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

</style>

<div class="container mt-4">
    <div class="row">
        <h5>Informacije o članu</h5>
    </div>
    <div class="row">
        <div class="col-md-4">
        <div class="row">
                <span>{{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}</span><br>
                <span>Spol: {{ $data['data']['attributes']['Spol'] }}</span>
                <span>Datum rojstva: {{ date('d-m-Y', strtotime($data['data']['attributes']['Rojstni_dan'])) }}</span>
            </div>
            <div class="row">
                @if (isset($data['data']['attributes']['Profilna_slika']['data']['attributes']['url']))
                <img src="http://localhost:1337{{ $data['data']['attributes']['Profilna_slika']['data']['attributes']['url'] }}">
                @else
                <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" style="transform: scale(0.5);">
                @endif
            </div>
        
        </div>
        @if(isset($data['data']['attributes']['Zivljenjepis']['data']))
        <div class="col-md-8">
            <h5>Življenjepis {{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}</h5>
            <div id="outputZivljenjepis"></div>
        </div>
        @endif
    </div>
    @if(isset($data['data']['attributes']['Rokopis']['data']))
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>Rokopis</h3>
            <div id="rokopisContainer">
                <img src="http://localhost:1337{{ $data['data']['attributes']['Rokopis']['data'][0]['attributes']['url'] }}" style="width: 50%;">
            </div>
        </div>
    </div>
    <hr>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Članki</h3>
            </div>
            @foreach($data['data']['attributes']['clanki']['data'] as $val)
            <div class="col-md-3 mb-4">
                <div class="card d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        <h5 class="card-title">Identifikacijska št. članka:{{ $val['id'] }}</h5>
                        <p class="card-text">Letnica knjige: {{ $val['attributes']['Letnica_zbornika'] }}</p>
                        <p class="card-text">Številka knjige: {{ $val['attributes']['Stevilka_knjige'] }}</p>
                        <p class="card-text">Strani v knjigi: {{ $val['attributes']['Strani_od'] }}-{{ $val['attributes']['Strani_do'] }}</p>
                        <button data-book="{{ $val['id'] }}" class="btn btn-primary bookLoader" data-bs-toggle="modal" data-bs-target="#bookModal">
                        <span class="button-text">Preberi članek</span>
                        <span class="button-hover"></span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(isset($data['data']['attributes']['Dodatni_clanki']['data']))
    <hr>
    <h3>Dodatne objave člana</h3>
        @foreach($data['data']['attributes']['Dodatni_clanki']['data'] as $val)
           <a href="http://localhost:1337{{$val['attributes']['url']}}">{{$val['attributes']['url']}}</a><br />
        @endforeach
    @endif
    

<script src="../resources/js/main.js"></script>
<script src="../resources/js/bookifyPDF.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="https://kit.fontawesome.com/b0f29e9bfe.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    var defaultContent = $('.container-bookify').html();

    $(".bookLoader").click(function() {
    $('.container-bookify').html(defaultContent);
    var bookValue = $(this).data("book");
    fetch(`http://localhost:1337/api/clanki/${bookValue}?populate=*`)
        .then(response => response.json())
        .then(data => {
            let uri = data.data.attributes.Clanek.data.attributes.url;
            let url = "http://localhost:1337"+uri;        
            readPDFasBook(url,"prev-btn","next-btn","book",1);
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