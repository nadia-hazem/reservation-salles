<!--PROFIL PAGE-->

<?php
    session_start();
    if (!isset($_SESSION ['login'])) { // si la session n'est pas ouverte (protection de barre d'adresse)
        header('Location: connexion.php'); // redirection vers la page de connexion
    }
    session_abort();
    ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?> <!--connexion à la base de données-->

<?php // variables des informations de l'utilisateur
    $login = $_SESSION['login'];
    $password = $_SESSION['password']; 
?>

<section class="container my-5">
    <h1>Profil</h1>
    <div class="row h-100">

        <!-- Article gauche -->
        <div class="col bg-light align-items-end">
            
            <form action="" method="post">
                <div class="row mb-3 ">                
                    <h3 class="form_title center py-3">Modifier mon login</h3>
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="row my-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" value="<?=$login?>" name="login" required>
                </div>

                <div class="row my-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" placeholder="Saisissez mot de passe" name="password" required>
                </div>
                
                <div class="row mt-4">
                    <input type="submit" class="form-control btn btn-dark mx-1 w-25"  name='submit' value="Valider" >
                    <span class="small pt-1 text-secondary">Valider la modification de mon compte</span>
                </div>
                <div class="row mt-4">
                    <input type="submit" class="form-control btn btn-outline-danger mx-1 w-25" name="delete" value="Supprimer" />
                    <span class="small pt-1 text-secondary">Supprimer mon compte</span>
                </div>
                
                <?php

            if(isset($_POST ['submit']) && isset ($_POST ['login']) && isset ($_POST ['password'])){

                if (password_verify($_POST ['password'], $password)) { // vérification du mot de passe
                    $requete = "UPDATE utilisateurs SET login = '".$_POST ['login']."' WHERE login = '".$login."' ";
                    $resultat = mysqli_query($conn, $requete);
                    // stockage des nouvelles informations dans la session
                    $login = $_POST ['login'];
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                    echo "<p type='alert' class='alert alert-success alert-dismissible fade show'>Modification effectuée avec succès !</p>";
                    session_destroy();
                    /* header('Location: index.php'); */
                    
                } else {
                    echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Mot de passe incorrect</p>";
                }
            }
            else if (isset($_POST['delete'])) { // suppression du compte
                if (isset ($_POST ['password'])) {
                    if (password_verify($_POST['password'], $password)) {
                        $del = "DELETE FROM utilisateurs WHERE login = '$login' ";
                        if ($conn->query($del) === TRUE) {
                            echo '<span type="alert" class="alert alert-danger alert-dismissible fade show">Utilisateur supprimé</span>';
                            session_destroy();
                            // header('Location: index.php'); provoque une erreur
                            // header('refresh:2, url=index.php');  affiche erreur mais supprime user
                        } else {
                            echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Erreur de suppression</p>";
                        }
                    } else {
                        echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Mot de passe incorrect</p>";
                    }
                } else {
                    echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Veuillez saisir votre mot de passe</p>";
                }
            }

            ?>
            </form>
        </div>

        <!-- Article droite -->
        <div class="col-sm p-3 bg-light h-100">
            <form action="" method="post">
                <div class="row mb-3">
                    <h3 class="form_title center">Changer de mot de passe</h3>
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div class="row mb-3">
                    <label for="password" class="form-label">Ancien mot de passe</label>
                    <input type="password" class="form-control" placeholder="Saisissez ancien mot de passe" name="oldpassword" required>
                </div>
                <div class="row mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" placeholder="Saisissez nouveau mot de passe" name="password1" required>
                </div>
                <div class="row mb-3">
                    <label for="password" class="form-label">Confirmez le mot de passe</label>
                    <input type="password" class="form-control" placeholder="Confirmez mot de passe" name="password2">
                </div>
                <div class="row mb-3">
                    <input type="submit" class="form-control btn btn-dark w-25" id='submit' value="Valider" >

        <?php

            if(isset ($_POST ['oldpassword']) && isset ($_POST ['password1']) && isset ($_POST ['password2'])){
                $oldpassword = $_POST ['oldpassword'];
                $password1 = $_POST ['password1'];
                $password2 = $_POST ['password2'];

                if (password_verify($oldpassword, $password)) { // vérification du mot de passe (ancien mot de passe)
                    if ($password1 == $password2) { // vérification de la correspondance du nouveau mot de passe
                        $password = password_hash($password1, PASSWORD_DEFAULT); // hashage du nouveau mot de passe

                        $requete = "UPDATE utilisateurs SET password = '".$password."' WHERE login = '".$login."' ";
                        $resultat = mysqli_query($conn, $requete);
                        // stockage des nouvelles informations dans la session
                        $_SESSION['password'] = $password;

                        echo "<p class'type='alert' class='alert alert-success alert-dismissible fade show'>Mot de passe modifié avec succès</p>";

                    }
                    else {
                        echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Les mots de passe ne correspondent pas</p>";
                    }
                }
                else {
                    echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>L'ancien mot de passe est incorrect</p>";
                }
            }
        ?>
                </div>
            </form>
        </div>
    </div> <!-- end row -->
</section> <!--end container-->

<?php include 'includes/footer.php';?>