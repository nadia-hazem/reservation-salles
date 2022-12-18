<!-- RESERVATION PAGE -->

<?php
    session_start();           
    if (!$_SESSION ['login']) { // si la session n'est pas ouverte (protection de barre d'adresse)
        header('Location: connexion.php'); // redirection vers la page de connexion
    }
    session_abort();
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?> <!--connexion à la base de données-->

<?php

    if (isset($_GET['id'])) 
    {
        $id = (int)$_GET['id'];

        // récupération des réservations
        $request = "SELECT reservations.titre, reservations.description, DATE_FORMAT(reservations.debut, '%d-%m-%Y %H') as debut, DATE_FORMAT(reservations.fin, '%d-%m-%Y %H') as fin, utilisateurs.login FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE reservations.id = $id";
        $exect_request = mysqli_query($conn, $request);
        $reservations = mysqli_fetch_assoc($exect_request);
        // Récupération de la date et des heures de la résa
        list($date, $heure_d) = explode(" ", $reservations['debut']);
        list($date, $heure_f) = explode(" ", $reservations['fin']);
    }

?>

        <main role="main">

            <div class="container my-5">
                <div>
                    <h2 class="text-center"><?php echo $reservations['titre']; ?></h2>
                </div>
                <div class="table-responsive w-50 m-auto">
                    <h4 class="lead text-center bg-light py-3">Détails de la réservation</h4>
                    <table class="table">                        
                        <tr><td class="text-left"><b>Réservé par l'utilisateur </b></td><td class="text-left"><?=$reservations['login']?></td></tr>
                        <tr><td class="text-left"><b>Titre de l'évènement </b></td><td class="text-left"><?=$reservations['titre']?></td></tr>
                        <tr><td class="text-left"><b>Description de l'évènement </b></td><td class="text-left"><?=$reservations['description']?></td></tr>
                        <tr><td class="text-left"><b>Début de l'évènement </b></td><td class="text-left"><?=$heure_d?> h </td></tr>
                        <tr><td class="text-left"><b>Fin de l'évènement </b></td><td class="text-left"><?=$heure_f?> h </td></tr>
                    </table>
                </div> <!-- /div table-responsive -->
            </div> <!-- /container -->
        </main>
        <?php include("includes/footer.php")?>
