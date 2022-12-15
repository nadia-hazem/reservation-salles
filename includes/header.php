<?php session_start() ?>

<!--HEADER BLOC-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/hero-form.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/animations.css" media="screen" type="text/css" />
    <!--FONT-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,700,800" rel="stylesheet">
    <script src="https://kit.fontawesome.com/12c357b92c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--TITLE-->
    <title>Réservation de salles</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">SmartOffice</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav  me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="planning.php">Planning</a>
                        </li>
                        <li class="nav-item"> <!-- Onglet réservation désactivé si utilisateur déconnecté-->
                            <a class="nav-link <?php if (!isset($_SESSION['login'])){echo 'disabled';}?>" href="reservation-form.php">Réserver une salle</a>
                        </li>

                        <?php if (!isset($_SESSION['login'])) : ?> <!-- dropdown Utilisateur déconnecté -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                    Espace membre
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="inscription.php">Inscription</a></li>
                                    <li><a class="dropdown-item" href="connexion.php">Connexion</a></li>
                                </ul>
                            </li>

                        <?php else: ?> <!-- dropdown utilisateur connecté-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                    Votre espace
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div> <!-- /navbar-collapse -->
            </div> <!-- /container-fluid -->
        </nav>
    </header>