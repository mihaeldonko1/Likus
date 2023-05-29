@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: beige;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
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
    background-color: #6ca7cc;
    color: #fff;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.custom-button:hover {
    background-color: #4f81a1;;
    color: #fff; 
    
}

</style>

<div class="container">
    <div class="row">
        <div class="col-md-4 platnica-container">
            <div class="row">
                <div class="col-md-12">
                    @if (isset($item['attributes']['Slika_platnice']['data'][0]['attributes']['url']))
                        <img src="http://localhost:1337{{ $item['attributes']['Slika_platnice']['data'][0]['attributes']['url'] }}" class="card-img-top mx-auto d-block mt-3">
                    @else
                        <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block mt-3">
                    @endif
                </div>
            
                <div class="col-md-12">
                    <span>Naslov: {{$data['data']['attributes']['Naslov']}}</span><br />
                    <span>Letnica izdaje: {{$data['data']['attributes']['Leto']}}</span><br />
                    <span>Številka zbornika: {{$data['data']['attributes']['Zbornik_st']}}</span><br />
                    <span>Urednik: {{$data['data']['attributes']['Urednik']}}</span><br />
                    <br>
                    <a href="/preberi/{{$data['data']['attributes']['Stevilka_knjige']}}" class="custom-button">Začni z branjem</a>


                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$data['data']['attributes']['Naslov']}} ({{$data['data']['attributes']['Leto']}})</h1>
                    <hr>
                </div>
                @if (isset($item['attributes']['Slika_platnice']['data'][0]['attributes']['url']))
                    <div class="col-md-12">
                        <h5>Opis knjige</h5>
                        <div class="opis-knjige">
                            {{$data['data']['attributes']['Opis_knjige']}}
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <h5>Opis knjige</h5>
                        <div class="opis-knjige">
                            <h6>Žal trenutno ni opisa za izbrano knjigo v spletni čitalnici Likus-a.</h6>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection