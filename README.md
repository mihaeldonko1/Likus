

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/mihaeldonko1/Likus">
    <img src="LikusFrontend/resources/img/random_slike/LIKUS_logo.png" alt="Logo" width="400">
  </a>
</div>



<!-- KAZALO -->

<details>
  <summary>Kazalo</summary>
  <ol>
    <li>
      <a href="#o-projektu">O Projektu</a>
    </li>
    <li>
    <a href="#izgrajeno-z">Izgrajeno z</a>
    </li>
    <li>
    <a href="#vzpostavitev">Vzpostavitev</a>
    </li>
    <li>
    <a href="#uporaba">Uporaba</a>
    </li>
    <li>
    <a href="#sodelujoči">Sodelujoči</a>
    </li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## O Projektu

<img src="https://i.ibb.co/PFhG2fh/likusmain.jpg" alt="Logo">

Pri praktikumu nam je bilo predstavljenih veliko različnih projektov, vendar nas je delo pri prostovoljnem neprofitnem društvu Likus najbolj pritegnilo. Ta projekt nam je bil zanimiv predvsem zaradi tega, ker smo imeli možnost spoznati veliko novih tehnologij, kot so uporaba microweberja, selitev podatkovnih baz ter postavitev spletnega strežnika, prav tako pa je vso opravljeno delo bilo za dober namen.

Likus ohranja sloves največje organiziranje literarnih piscev v Republiki Sloveniji (ljubiteljev) z več kot 30 letno tradicijo pisanja. Združuje ljudsko besedo takšno kot je v prozi in pesmih. Izražena je ljubezen, veselje, žalost, bolečina, grenki in vedri spomini na življenje ljudi, dogodke, ki so se zgodili, spomini na čase, ki jih nikoli več ne bo. Z veliko mero solidarnosti in sočutnosti omogoča ustvarjanje zbirke vsem, ki to želijo in izražajo s pisanem v izvirni obliki, tako kot jo je nekdo doživel in čutil. Umetniška vrednost je manj pomembna od vsebine in ravno zato je ta dokument časa širši. Pisanje ni omejeno na peščico piscev ampak, je omogočena objava vsebin, ki je sicer nebi bilo.

Naš namen je tako bil vzpostaviti aplikacijo, preko katere lahko vsak uporabnik prosto bere vse že objavljene knjige in članke. V primeru, da uporabnik ni registriran se mu ponudi možnost registracije ter izbira članstva v društvu. Izbira lahko med prijavo v enega izmed dveh društev (SLPS - brez članarine, LIKUS - s članarino). Registriran uporabnik lahko nato ureja svoj profil (slika, telefonska številka, email, naslov), prav tako pa lahko naloži tudi svoj rokopis ter življenjepis. Glavna funkcionalnost registriranega uporabnika pa je predvsem objavljanje člankov ter knjig ki jih je napisal (te objave morajo biti potrjene s strani administratorja). V primeru, da registriran uporabnik pozabi geslo, ga lahko vedno ponastavi preko vnešenega maila z klikom na gumb "pozabljeno geslo".

<p align="right">(<a href="#readme-top">nazaj na vrh</a>)</p>



## Izgrajeno z

* [![Microweber][Microweber.com]][Microweber-url]
* [![NodeJS][NodeJS.com]][NodeJS-url]
* [![Strapi][Strapi.com]][Strapi-url]
* [![Laravel][Laravel.com]][Laravel-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![JQuery][JQuery.com]][JQuery-url]
* [![MySQL][MySQL.com]][MySQL-url]


<p align="right">(<a href="#readme-top">nazaj na vrh</a>)</p>



<!-- Vzpostavitev -->
## Vzpostavitev 

Priporočene verzije:
  <ul>
    <li>
      Microweber
        ```sh
        1.2
        ```
    </li>
    <li>
      Strapi
        ```sh
        4.10.5
        ```
    </li>
    <li>
      NodeJS
        ```sh
        18.16.0
        ```
    </li>
    <li>
      PHP
        ```sh
        8.2.6
        ```
    </li>
  </ul>


1. Kloniranje repozitorija
   ```sh
   git clone https://github.com/mihaeldonko1/Likus.git
   ```
2. Inštalacija NPM paketov
   ```sh
   cd .\LikusBackend\
   npm install
   ```


<p align="right">(<a href="#readme-top">nazaj na vrh</a>)</p>



<!-- Uporaba -->
## Uporaba

1. NPM
   ```sh
   cd .\LikusBackend\
   npm run develop
   ```
2. PHP
   ```sh
   cd .\LikusFrontend\
   php artisan serve
   ```


<p align="right">(<a href="#readme-top">nazaj na vrh</a>)</p>



<!-- Sodelujoči -->
## Sodelujoči
  <ul>
    <li>
      Mihael Donko
    </li>
    <li>
      Jan Volovšek
    </li>
    <li>
      Miha Horvat
    </li>
  </ul>

  <p align="right">(<a href="#readme-top">nazaj na vrh</a>)</p>




<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[NodeJS.com]: https://img.shields.io/badge/NodeJS-FF2D20?style=for-the-badge&logo=Node.JS&logoColor=white&color=green
[NodeJS-url]: https://nodejs.org/en
[Strapi.com]: https://img.shields.io/badge/Strapi-FF2D20?style=for-the-badge&logo=Strapi&logoColor=white&color=blue
[Strapi-url]: https://strapi.io/
[Microweber.com]: https://img.shields.io/badge/Microweber-FF2D20?style=for-the-badge&logo=makerbot&logoColor=white&color=blue
[Microweber-url]: https://microweber.com/
[MySQL.com]: https://img.shields.io/badge/MySQL-FF2D20?style=for-the-badge&logo=MySQL&logoColor=white
[MySQL-url]: https://www.mysql.com/
[PHP.com]: https://img.shields.io/badge/PHP-FF2D20?style=for-the-badge&logo=PHP&logoColor=white&color=908fe3
[PHP-url]: https://www.php.net/

[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&color=red
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com 