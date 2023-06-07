<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Čitalnica</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/basic.css">
<style>
    .card-img {
        height: 200px ;
        width: 200px !important;
        object-fit: cover;
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
</head>
    <body>
        @include('layouts.header')
      
        @yield('content')
        
        @include('layouts.footer')
    </body>
</html>