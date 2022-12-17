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

<section class="container mb-5">
    <h1>PROFIL</h1>
    <div class="row align-items-center">

        <!-- Article gauche -->
        <article class="col ml-auto mr-auto">
            
            <form action="" method="post">
                <div class="row mb-3 ">                
                    <h3 class="form_title center">Modifier mon login</h3>
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="row mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" value="<?=$login?>" name="login" required>
                </div>

                <div class="row mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" placeholder="Saisissez mot de passe" name="password" required>
                </div>
                
                <div class="row mb-3">
                    <input type="submit" class="form-control"  name='submit' value="Valider" >
                </div>
                
                <div class="row mb-3">
                    <input type="submit" class="form-control"  name="delete" value="Supprimer mon compte" />
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
                    echo '<p class="green">Modification effectuée avec succès !</p>';
                    session_destroy();
                    /* header('Location: index.php'); */
                    
                } else {
                    echo "<p style='color:red'>Mot de passe incorrect</p>";
                }
            }
            else if (isset($_POST['delete'])) { // suppression du compte
                if (isset ($_POST ['password'])) {
                    if (password_verify($_POST['password'], $password)) {
                        $del = "DELETE FROM utilisateurs WHERE login = '$login' ";
                        if ($conn->query($del) === TRUE) {
                            echo '<span class="green">Utilisateur supprimé</span>';
                            session_destroy();
                            // header('Location: index.php');
                        } else {
                            echo "<p style='color:red'>Erreur de suppression</p>";
                        }
                    } else {
                        echo "<p style='color:red'>Mot de passe incorrect</p>";
                    }
                } else {
                    echo "<p style='color:red'>Veuillez saisir votre mot de passe</p>";
                }
            }

        ?>
            </form>
        </article>

        <!-- Article droite -->
        <article class="col-sm">
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
                    <input type="password" class="form-control" name="password2">
                </div>
                <div class="row mb-3">
                    <input type="submit" class="form-control" id='submit' value="Valider" >
                </div>
            </form>
        </article>

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

                        echo "Mot de passe modifié avec succès";

                    }
                    else {
                        echo "<p style='color:red'>Les mots de passe ne correspondent pas</p>";
                    }
                }
                else {
                    echo "<p style='color:red'>L'ancien mot de passe est incorrect</p>";
                }
            }
        ?>
        
    </div> <!-- end row -->
</section> <!--end container-->

<?php include 'includes/footer.php';?>