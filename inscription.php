<!--INSCRIPTION PAGE-->
<?php include 'includes/header.php';?>
<?php include 'includes/dbconnect.php';?>    <!--connexion à la base de données-->

<main role="main" class="container">
    <?php
        //par défaut, on affiche le formulaire
        $AfficherFormulaire=1;
        //traitement du formulaire:
        if(isset($_POST['login'],$_POST['password'])){
            $login = mysqli_real_escape_string($conn, htmlspecialchars($_POST['login']));
            $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
            $select = mysqli_query($conn,"SELECT * FROM utilisateurs WHERE login='".$_POST['login']."'");

            if($_POST['login'] = ""){ // si le login est vide
                echo "<p style='color:red' class='alert alert-dark alert-dismissible fade show'>Le champ nom d'utilisateur est vide.</p>";
            } 
            elseif(mysqli_num_rows($select)) {
                echo "<p class='alert alert-dark alert-dismissible fade show' style='color: red;'>Ce nom d\'utilisateur existe déjà</p>";
            } 
            elseif($_POST['password']== "" || $_POST['password2']== ""){
                echo "<p class='alert alert-dark alert-dismissible fade show' style='color:red'>Le champs Mot de passe est vide.</p>";
            } 
            elseif ($_POST['password'] != $_POST['password2']) { 
                echo "<p class='alert alert-dark alert-dismissible fade show' style='color:red'>Les mots de passe ne correspondent pas.</p>";
            } 
            else {
                //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
                //cryptage du mot de passe
                $password = password_hash($password, PASSWORD_DEFAULT);
                if(!mysqli_query($conn,"INSERT INTO utilisateurs (login, password) values('".$login."', '".$password."')")) {
                    echo "<p style='color:red'>Une erreur s'est produite: </p>".mysqli_error($conn);
                } else {
                    echo "Vous êtes inscrit(e) avec succès!";
                    //on n'affiche plus le formulaire
                    $AfficherFormulaire=0;
                    header('Location: connexion.php'); // redirection vers la page de connexion
                }
            }
            mysqli_close($conn); // fermeture de la connexion à la base de données pour plus de propreté
        }
        if($AfficherFormulaire==1){ // si le formulaire doit être affiché
    ?>

                
    <div class="col-6 ml-auto mr-auto">
    
        <form method="post" action="">
            <h1>Créez un compte</h1>

            <div class="col  mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" name="login" required>
            </div>

            <div class="col  mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Saisissez mot de passe" name="password" required>
            </div>

            <div class="col  mb-3">
                <label for="password" class="form-label">Confirmez le mot de passe </label>
                <input type="password" class="form-control" name="password2" required>
            </div>

            <div class="col  mb-3">
                <input type="submit" class="form-control submit" name="inscription" value="Inscription">
            </div>
        </form>
    </div> <!-- /col -->

    <?php
        }
    ?>

</main> <!-- /main -->

<?php include 'includes/footer.php';?>