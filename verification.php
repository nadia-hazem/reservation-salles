<!--VERIFICATION PAGE-->
<?php
    include 'includes/dbconnect.php';  // connexion à la base de données
    session_start(); // démarrage de la session
        if(isset($_POST['login']) && isset($_POST['password'])) // on parcourt les données du formulaire
        {       
            // pour éliminer toute attaque de type injection SQL et XSS
            $login = mysqli_real_escape_string($conn,htmlspecialchars($_POST['login'])); 
            $password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['password']));

            if($login !== "" && $password !== "") // si les champs sont remplis
            {
                $requete = "SELECT count(*) FROM utilisateurs where 
                login = '".$login."' "; // on récupère le nombre de lignes qui correspondent au login
                $exec_requete = mysqli_query($conn,$requete); // on exécute la requête
                $reponse = mysqli_fetch_array($exec_requete); // on récupère le résultat
                $count = $reponse['count(*)']; // on récupère le nombre de lignes

                if($count!=0) // nom d'utilisateur correct
                {
                    $requete = "SELECT password FROM utilisateurs where login = '".$login."' "; // on récupère le mot de passe
                    $exec_requete = mysqli_query($conn,$requete); // on exécute la requête
                    $reponse = mysqli_fetch_array($exec_requete); // on récupère le résultat
                    $passwordbdd = $reponse['password']; // on récupère le mot de passe
                    if(password_verify($password, $passwordbdd)){ // password connection contre password base de données
                        $_SESSION['login'] = $login; // on stocke le login dans la session
                        $requete = "SELECT * FROM utilisateurs where login = '".$login."' "; // on récupère les données de l'utilisateur
                        $exec_requete = mysqli_query($conn,$requete); // on exécute la requête
                        $reponse = mysqli_fetch_array($exec_requete); // on récupère le résultat

                        $_SESSION['password'] = $reponse['password']; // on stocke le mot de passe dans la session
                        $_SESSION['id'] = $reponse['id']; // on stocke l'id dans la session

                        $_SESSION['loginOK'] = true;    // on ouvre la session
                        header('Location: profil.php'); // redirection vers la page profil
                    }
                    else{
                        header('Location: connexion.php?erreur=1'); // mot de passe incorrect
                    }
                }
                else
                {
                        header('Location: connexion.php?erreur=1'); // utilisateur incorrect
                    }
            }
            else
            {
                header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
            }
        }
        else
        {
            header('Location: connexion.php'); // redirection vers la page de connexion
        }
    mysqli_close($conn); // fermer la connexion
?>
