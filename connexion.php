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
        $alert = "Ce login n'existe pas.";
    } elseif ($status == "password") {
        $alert = "Vérifiez votre mot de passe.";
    } elseif ($status == "connecte") {
    $alert = 'Connexion réussie. Bienvenue @'.$user->getLogin().'<br> 
    <a href="template.php?page=profil">Visiter votre profil</a>';
    }

    if ($succes == 1) { //si connexion, stockage instance dans session
    $_SESSION['login'] = $user;
    }
}
?>

<main role="main" class="container"> 

    <div class="col-6 ml-auto mr-auto"> 

        <form action="verification.php" method="POST"> <!-- traitement du form par la page de vérification -->
            <h1>Connexion</h1>

            <?php if (isset($alert)) : ?> <!-- Alerte erreur-->
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <?php echo $alert; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="col mb-3">
                <label for="login" class="form-label">Login</label>
                <input id="login" class="form-control" type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>
            </div>

            <div class="col mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" class="form-control" type="password" placeholder="Entrer le mot de passe" name="password" required>
            </div>
            
            <div class="col mb-3">
                <input class="form-control submit" type="submit" id='submit' value='Connexion' >
                <p>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
            </div>
            <?php

            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1 || $err==2)
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }?>
            
        </form>
    </div>

</main> <!-- /main -->

<?php include 'includes/footer.php';?>
