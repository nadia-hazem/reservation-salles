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

/*         $requete = "SELECT reservations.titre, reservations.description, reservations.debut, reservations.fin, utilisateurs.login FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE reservations.id = $id";
        $queryusers = mysqli_query($conn, $requete);
        $resultatusers = mysqli_fetch_assoc($queryusers); */

        // récupération des réservations
        $request = "SELECT reservations.titre, reservations.description, DATE_FORMAT(reservations.debut, '%d-%m-%Y %H') as debut, DATE_FORMAT(reservations.fin, '%d-%m-%Y %H') as fin, utilisateurs.login FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE reservations.id = $id";
        $exect_request = mysqli_query($conn, $request);
        $reservations = mysqli_fetch_assoc($exect_request);
        // Récupération de la date et des heures de la résa
        list($date, $heure_d) = explode(" ", $reservations['debut']);
        list($date, $heure_f) = explode(" ", $reservations['fin']);
    }

?>

        <main>
            <section id="event">
                <section id="event-inner">
            <?php 
                    echo "<b>Réservée par l'utilisateur </b> ".$reservations['login']."<br>";
                    echo "<b>Titre de l'évènement </b> ".$reservations['titre']."<br>";
                    echo "<b>Description de l'évènement </b> " .$reservations['description']."<br>";
                    echo "<b>Début de l'évènement </b> " .$heure_d."<br>"; 
                    echo "<b>Fin de l'évènement </b> " .$heure_f."<br>"; 
            ?>
                </section>
            </section>
        </main>
        <?php include("includes/footer.php")?>
