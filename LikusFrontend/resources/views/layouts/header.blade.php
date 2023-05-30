<style>
        .navbar {
            background-color: #EDEDC2;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            padding: 14px 50px 14px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #logo {
            height: 33px;
            width: auto;
        }

        .nav-links {
            display: flex;
            flex-grow: 1;
            justify-content: center;
            align-items: center;
        }

        .nav-link {
            margin: 0 10px;
            font-family: "Lato", sans-serif;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #6ca7cc;
        }

        .nav-links .nav-link:not(:last-child) {
            margin-right: 60px;
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
    } else {
        throw new Exception("User not found.");
    }
} catch (Exception $e) {
    $userMail = null;
}
?>

    <nav class="navbar">
        <div class="navbar-brand">
            <img id="logo" src="http://127.0.0.1:8000/userfiles/media/default/likus-logo2_3.png" alt="Logo">
        </div>
        <div class="nav-links">
            <a class="nav-link" href="/spletna-citalnica">O spletni čitalnici</a>
            <a class="nav-link" href="/clani?page=1">Avtorji</a>
            <a class="nav-link" href="/knjige">Knjige</a>
            @if(isset($userMail) && ($userMail != null || $userMail != "" || $userMail != 0))
                <button onclick="OpenProfile()" class="btn btn-primary" style="background-color: #e89443;border: 1px solid #e89443;">Vaš profil</button>
            @endif
        </div>
    </nav>

    <script>
    function OpenProfile() {
        var userMail = "<?php echo $userMail; ?>";
        fetch(`http://localhost:1337/api/clanis?filters[Email][$eq]=${userMail}`)
        .then(response => response.json())
        .then(data => {
            personID = data['data'][0]['id'];
            window.location.href = "/clan/"+personID;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Prišlo je do napake pri nalaganju vašega računa.')
        });

    }


    </script>