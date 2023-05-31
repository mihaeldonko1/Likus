@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: beige !important;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .column {
            flex-basis: 45%;
        }

        h1{
            font-size: 60px;
            color: #6ca7cc;
        }
    </style>

    <div class="container">
        <div class="column">
            <br>
            <br>
            <br>
            <h1>LIKUS:</h1>
            <br>
          
             <h5> - Prostor in zatočišče za mnoge ljubiteljske pisatelje in pesnike </h5> 
             <h5> - Članstvo je plačljivo  </h5>
             <h5> - Namenjeno je pisateljem </h5>
             <h5> - Ima več kot 30-letno tradicijo </h5>
             <h5> - Povezovanje ljudske besede v prozi in pesmih. </h5>
             <h5> - Omogoča objavo in izražanje </h5>
             <h5> - Omogoča objavo ustvarjalnih zamisli. </h5>
             <h5> - Organizira letovanja, izlete in dogodivščine v Volčjem taboru </h5>
             <h5> - Pridobivanje novih pisateljev </h5>
             <h5> - Krovna organizacija literarnih piscev v Sloveniji </h5>
            </>
        </div>
        <div class="column">
            <br>
            <br>
            <br>
            <h1>SLPS:</h1>
            <br>
           

            <h5> - Portal namenjen vsem ljubiteljem pisane besede  </h5> 
            <h5> - Brezplačen vpis  </h5> 
            <h5> - Podporno okolje za ustvarjalce, društva in posameznike.  </h5> 
            <h5> - Informiranje o lokalnih dogodkih, izobraževanjih in letovanjih. </h5> 
            <h5> - Prispeva k izboljšanju položaja literarnih društev.  </h5> 
         
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>  
    <br>

@endsection
