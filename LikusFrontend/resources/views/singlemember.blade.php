<?php
if (isset($data['data']['attributes']['Zivljenjepis']['data']) && $data['data']['attributes']['Zivljenjepis']['data'] != null) {
    $zivljenjepisId = $data['data']['attributes']['Zivljenjepis']['data'][0]['attributes']['url'];
} else {
    $zivljenjepisId = 0;
}
?>
<?php
use Carbon\Carbon;
try {
    $birthday = Carbon::createFromFormat('Y-m-d', $data['data']['attributes']['Rojstni_dan']);
    $currentDate = Carbon::now();
    $yearsDifference = $birthday->diffInYears($currentDate);
} catch (Exception $e) {
    $yearsDifference = 0;
}
?>

@extends('layouts.app')
@section('content')

<style>
    body {
        background-color: beige !important;
        overflow-x: hidden;
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
                        <img src="{{ config('likusConfig.likus_api_urlMain') }}{{ $data['data']['attributes']['Profilna_slika']['data']['attributes']['url'] }}" style="width: 80%; margin-bottom: 10px; border-radius: 20px">
                    @else
                        <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" style="width: 80%; margin-bottom: 10px; border-radius: 20px">
                    @endif
                    </div>
                </div>
                
                <div class="col-md-12 text-center">
                    <div class="row">
                        <span style="font-size: 2.0em;">{{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}</span><br>
                        <span style="font-size: 1.2em;">Datum rojstva: {{ date('d-m-Y', strtotime($data['data']['attributes']['Rojstni_dan'])) }}</span>
                        <span style="font-size: 1.2em;">Spol: {{ $data['data']['attributes']['Spol'] }}</span><br>
                        <span style="font-size: 1.2em;">Starost: {{ $yearsDifference }}</span><br>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-7">
     @if(isset($data['data']['attributes']['Zivljenjepis']['data']))
        <div class="col-md-12">
            <div class="rounded p-3 shadow" style="background-color: white;">
            <h2>Življenjepis {{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }}</h2><br>
                <button class="btn btn-primary" onclick="odpriŽivljenjepis()">Preberi Življenjepis</button>
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
                <img src="{{ config('likusConfig.likus_api_urlMain') }}{{ $data['data']['attributes']['Rokopis']['data'][0]['attributes']['url'] }}" style="width: 50%;">
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
                        <button data-book="{{ $val['id'] }}" class="btn btn-primary bookLoader button-with-shadow" style="margin-bottom: 20px;">
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


    @if(isset($data['data']['attributes']['dodatne_objave']['data'][0]))
    <hr class="style-hr">
    <div class="row">
    <h3>Dodatne objave člana</h3>
        @foreach($data['data']['attributes']['dodatne_objave']['data'] as $val)
        <div class="col-md-3 mb-4">
                <div class="card d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        @if(isset($val['data']['attributes']['natecaj']['id']))
                        <img src="{{ config('likusConfig.likus_api_urlMain') }}{{ $val['data']['attributes']['natecaj']['attributes']['Naslovnica']['data']['attributes']['url'] }}" class="card-img-top mx-auto d-block mt-3 card-img" style="height:300px !important"> <br>
                        @else
                            <img src="" class="card-img-top mx-auto d-block mt-3 card-img" style="height:300px !important"> <br>
                        @endif
                        <p class="card-text">{{ $data['data']['attributes']['Ime'] }} {{ $data['data']['attributes']['Priimek'] }} članek {{$val['data']['id']}}</p>
                        @if(isset($val['data']['attributes']['natecaj']['id']))
                        <p class="card-text">Natečaj: {{$val['data']['attributes']['natecaj']['attributes']['Ime']}}</p>
                        @else
                        <p class="card-text">Samostojna objava</p>
                        @endif
                        <a class="btn btn-primary" href="{{ config('likusConfig.likus_api_urlMain') }}{{$val['data']['attributes']['Clanek']['data']['attributes']['url']}}" target="_blank">Preberi več</a>
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
        var bookValue = $(this).data("book");
        fetch(`{{ config('likusConfig.likus_api_url') }}/clanki/${bookValue}?populate=*`)
            .then(response => response.json())
            .then(data => {
                let uri = data.data.attributes.Clanek.data.attributes.url;
                let fullurl = "{{ config('likusConfig.likus_api_urlMain') }}"+uri;        
                window.open(fullurl, '_blank');
            })
            .catch(error => {
                console.error(error);
            });
        });


});

function odpriŽivljenjepis(){
    let zivljenjepisId = "{{ config('likusConfig.likus_api_urlMain') }}<?php echo $zivljenjepisId; ?>";
    window.open(zivljenjepisId, '_blank');
}



</script>

<script>
  document.getElementById("closeButton").addEventListener("click", function() {
    location.reload();
  });
</script>



@endsection