@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: beige !important;
    }

    .container {
        justify-content: center;
        align-items: center;
    }

    .platnica-container {
        text-align: center;
    }

    .opis-knjige {
        text-align: justify;
    }

    .custom-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #e89443;
    color: #fff;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.custom-button:hover {
    background-color: #e89443;
    color: #fff; 
    
}

h1{
color: #e89443;
} 

#searchButton,
#clearButton {
  background-color: #e89443;
  border-color: #e89443;
  color: #fff;
  transition: background-color 0.3s;
  border-radius: 5px;
  padding: 10px 20px;
}

#searchButton:hover,
#clearButton:hover {
  background-color: #c9721e;
  border-color: #c9721e;
}


.shadow {


box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.button-with-shadow {
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
}

h1{
    color: #e89443;
}

.i_barva_naslova{

    color: #e89443;
    font-size: 20px;
    font-weight: bold;
}


</style>

<br>
<br>
<br>

<div class="container">        
    <div class="row">
        <div class="col-md-12 text-center">
                <h1 style="font-size: 3.7em; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">
                {{$data['data']['attributes']['Naslov']}} ({{$data['data']['attributes']['Leto']}})
                </h1>
        </div>
    </div>
    
    <br>
    <br>
    <br>

    <div class="row">  
            <div class="col-md-6 platnica-container">
            <div class="row">
                <div class="col-md-12">
                    @if (isset($data['data']['attributes']['Slika_platnice']['data']['attributes']['url']))
                        <img src="http://localhost:1337{{ $data['data']['attributes']['Slika_platnice']['data']['attributes']['url'] }}" class="card-img-top mx-auto d-block" style="width: 60%; margin-bottom: 15px;">
                    @else
                        <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block" style="width: 60%; margin-bottom: 15px;">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span style="font-size: 1.2em;">Naslov: <i class="i_barva_naslova">{{$data['data']['attributes']['Naslov']}}</i></span><br />
                    <span style="font-size: 1.2em;">Letnica izdaje: <i>{{$data['data']['attributes']['Leto']}}</i></span><br />
                    <span style="font-size: 1.2em;">Številka zbornika: <i>{{$data['data']['attributes']['Zbornik_st']}}</i></span><br />
                    <span style="font-size: 1.2em;">Urednik: <i>{{$data['data']['attributes']['Urednik']}}</i></span><br />
                    <br>
                </div>
            </div> 
        </div>
        <div class="col-md-6 text-center">
            <div class="row">
                <div class="col-md-12 text-center rounded p-3 shadow" style="background-color: white">
                <br>        
                @if (isset($item['attributes']['Slika_platnice']['data'][0]['attributes']['url']))
                    <div class="col-md-12 text-center">
                        <h1>Opis knjige:</h1><br><br>
                        <div class="opis-knjige text-center">
                            {{$data['data']['attributes']['Opis_knjige']}}
                        </div>
                    </div>
                @else
                    <div class="col-md-12 text-center">
                        <h1>Opis knjige:</h1><br><br>
                        <div class="opis-knjige text-center">
                            <h6>Žal trenutno ni opisa za izbrano knjigo v spletni čitalnici Likus-a.</h6>
                        </div>
                    </div>
                @endif

                <div class="text-center">
                <br />
                <br>

                <a href="/preberi/{{$data['data']['attributes']['Stevilka_knjige']}}" class="custom-button mb-5 button-with-shadow" id="searchButton" style="padding: 10px 60px; font-size: 20px;">Začni z branjem</a>
              
            </div>
              </div>



        </div>
            
        <br>

        </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>
@endsection