<style>
    .navbar {
        background-color: #EDEDC2;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        padding: 15px 54px 23px;
        display: flex;
        align-items: center;
    }

    .nav-links {
        display: flex;
        flex-grow: 1;
        justify-content: center;
        align-items: center;
    }

    .nav-link {
        margin: 0 35px;
        font-family: "Lato", sans-serif;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #e89443;
    }

    .btn {
        background-color: #e89443;
        border: 1px solid #e89443;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #c9721e;
        border-color: #c9721e;
    }

    .nav-buttons {
        margin-left: auto;
    }

    .btn-icon {
        height: 16px;
        width: 16px;
        margin-right: 5px;
        vertical-align: middle;
    }

    .hamburger-menu {
        display: none;
        cursor: pointer;
        margin-right: 10px;
    }

    .hamburger-menu .bar {
        display: block;
        width: 25px;
        height: 3px;
        background-color: #000;
        margin-bottom: 5px;
        transition: background-color 0.3s ease;
    }

    .hamburger-menu.active .bar:nth-child(2) {
        opacity: 0;
    }

    .hamburger-menu.active .bar:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    .hamburger-menu.active .bar:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        padding: 10px;
        z-index: 1000;
    }



    .dropdown-menu.open {
        display: block;
        background-color: #ffffff;
        position: absolute;
        width: 40%;
        left: 60%;
        padding: 0 5px;
    }

    .dropdown-menu a {
        display: block;
        margin: 5px 0;
        font-family: "Lato", sans-serif;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .dropdown-menu a:hover {
        color: #e89443;
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .nav-buttons {
            margin-left: 0;
        }

        .hamburger-menu {
            display: block;
        }

        .dropdown-menu {
            position: static;
            box-shadow: none;
            padding: 0;
            background-color: transparent;
        }

        .dropdown-menu a {
            margin: 0;
        }

        .profil{
            display: none
        }
    }

</style>



<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php
try {
    $user = get_user_by_id(user_id());
    if ($user !== false) {
        $userMail = $user['email'];
        $userName = $user['username'];

    } else {
        throw new Exception("User not found.");
    }
} catch (Exception $e) {
    $userMail = null;
}
?>

<nav class="navbar">

<div style="padding-top: 1px; padding-bottom: 3px;">
    <img id="logo" src="/resources/img/random_slike/LIKUS_logo2.png" style="width: 86px; height: auto;" alt="Logo">
</div>

    <div class="nav-links">
        <a class="nav-link" href="/spletna-citalnica">O spletni čitalnici</a>
        <a class="nav-link" href="/clani?page=1">Avtorji</a>
        <a class="nav-link" href="/knjige">Knjige</a>
    </div>
    
    <div class="nav-buttons">
        <?php if(isset($userMail) && ($userMail != null || $userMail != "" || $userMail != 0)): ?>
        <button onclick="OpenProfile()" class="btn btn-primary profil" style="display: flex; align-items: center;">
    <img id="logo" src="/resources/img/random_slike/ikona_pfp.png" alt="User Profile Icon" class="btn-icon-small" style="width: 24px; height: auto; margin-right: 6px;">
    <span style="color: white;"><?php echo $userName; ?></span>
</button>


        <?php endif; ?>
    </div>
    <div class="hamburger-menu">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <div class="dropdown-menu">
        <a class="nav-link" href="/spletna-citalnica">O spletni čitalnici</a>
        <a class="nav-link" href="/clani?page=1">Avtorji</a>
        <a class="nav-link" href="/knjige">Knjige</a>
        <?php if(isset($userMail) && ($userMail != null || $userMail != "" || $userMail != 0)): ?>
            <button onclick="OpenProfile()" class="btn btn-primary ">
                <img src="path/to/your/icon.png" alt="User Profile Icon" class="btn-icon">Vaš profil
            </button>
        <?php endif; ?>
    </div>
</nav>

<script>
    var hamburgerMenu = document.querySelector('.hamburger-menu');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    hamburgerMenu.addEventListener('click', function () {
        this.classList.toggle('active');
        dropdownMenu.classList.toggle('open');
    });

    function OpenProfile() {
        var userMail = "<?php echo $userMail; ?>";
        fetch(`<?php echo e(config('likusConfig.likus_api_url')); ?>/clanis?filters[Email][$eq]=${userMail}`)
            .then(response => response.json())
            .then(data => {
                personID = data['data'][0]['id'];
                window.location.href = "/clan/" + personID;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Prišlo je do napake pri nalaganju vašega računa.')
            });
    }
</script><?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\resources\views/layouts/header.blade.php ENDPATH**/ ?>