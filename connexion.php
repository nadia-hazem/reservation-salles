<!--CONNEXION PAGE-->

<?php include 'includes/header.php';?>
<?php include 'includes/dbconnect.php';?> <!-- connecxion à la base de données -->

<?php
if (isset($_SESSION['login'])) {header("location: profil.php");} //redirection utilisateur connecté

if (isset($_POST['submit'])) {
    $user = $_POST['login'];
    $succes = $user->connect($_POST['login'], $_POST['password']);

    $status = $user->getStatus(); //gestion messages erreurs
    if ($status == "login") {
        $alert = "<p class='alert alert-danger alert-dismissible fade show'>Ce login n'existe pas.</p>";
    } elseif ($status == "Mot de passe") {
        $alert = "<p class='alert alert-danger alert-dismissible fade show'>Vérifiez votre mot de passe.</p>";
    } elseif ($status == "connecté") {
    $alert = "<p class='alert alert-success alert-dismissible fade show'>Connexion réussie. Bienvenue @'.$user->getLogin().'<br> 
    <a href='template.php?page=profil'>Visitez votre profil</a>";
    }

    if ($succes == 1) { //si connexion, stockage instance dans session
    $_SESSION['login'] = $user;
    }
}
?>

<main role="main" class="container py-5"> 
    <div class="row">
        <div class="col-6 mx-auto py-3 bg-light"> 
            <ul class="list-group">
                <li class="list-group-item"><img src="img/room4.jpg" class="img-fluid border-white-5" alt="Responsive image"></li>
                <li class="list-group-item">Une fois connecté(e), vous pourrez réserver une salle, voir vos réservations, modifier votre profil, etc.</li>
                </li>
            </ul>
        </div>

        <div class="col-6 mx-auto py-3 bg-light"> 

            <form action="verification.php" method="POST"> <!-- traitement du form par la page de vérification -->
                <h1>Connexion</h1>

                <?php if (isset($alert)) : ?> <!-- Alerte erreur-->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $alert; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <div class="col pb-3">
                    <label for="login" class="form-label">Login</label>
                    <input id="login" class="form-control" type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>
                </div>

                <div class="col pb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" class="form-control" type="password" placeholder="Entrer le mot de passe" name="password" required>
                </div>
                
                <div class="col pb-3">
                    <input class="form-control submit" type="submit" id='submit' value='Connexion' >
                    <p>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
                </div>
                <?php

                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p class='alert alert-danger alert-dismissible fade show'>Utilisateur ou mot de passe incorrect</p>";
                }?>
                
            </form>
        </div>
    </div>    

</main> <!-- /main -->

<?php include 'includes/footer.php';?>
