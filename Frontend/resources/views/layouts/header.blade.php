<!DOCTYPE html>
<html>
<head>
    <title>Člani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/book.css">
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
</head>
<body>

<nav class="navbar navbar-expand-lg" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 0 50px;margin-bottom: 25px">
    <a class="navbar-brand" href="/">
    <i class="fas fa-arrow-left" style="font-size: 35px;color:black"></i>
    </a>
    <div class="navbar-brand">
      <img src="http://127.0.0.1:8000/userfiles/media/default/likus-logo2_3.png" height="50" alt="Logo">
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">O spletni čitalnici</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Avtorji</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Knjige</a>
        </li>    
      </ul>
    </div>  
</nav>

