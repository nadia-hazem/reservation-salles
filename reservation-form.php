<!-- RESERVATION-FORM PAGE -->

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

    if(isset($_SESSION['login']))

	if(isset($_POST["titre"]))
	{
		$titre=$_POST["titre"];
	}
	if(isset($_POST["description"]))
	{
		$description=$_POST["description"];
	}
	if(isset($_POST["dateDebut"]))
	{
		$dateDebut=$_POST["dateDebut"];
	}
	if(isset($_POST["dateFin"]))
	{
		$dateFin=$_POST["dateFin"];
	}

    error_reporting(0);
    ini_set('display_errors', 0);
    date_default_timezone_set("Europe/Paris");
    $loginlog = $_SESSION['id'];
    $intloginlog = intval($loginlog);
    $conn = mysqli_connect("localhost", "root","","reservationsalles");

?>

    <main>
        <div class="container my-3">

            <div class="row justify-content-center align-items-center">
                <article class="col-sm">
                    <form method="post" id="reservationform" action="">
                        <h1>Réservation</h1>

                        <?php if(isset($_SESSION['login']))
                        { ?>
                        <div class="row mb-3">
                            <label>Titre :</label>
                                <input type="text" name="titre" class="form-control" maxlength="50" placeholder="50 caractères maximum" required><br/><br/>
                        </div>
                        <div class="row mb-3">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" maxlength="200" placeholder="200 caractères maximum"required></textarea>
                        </div>
                        <div class="row mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" min= <?= date("Y-m-d", strtotime("now"))?> required ><br/><br/>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="heure_debut">Heure de début :</label>
                                <select name="heure_debut" required>
                                    <option value="08:00:00">08h</option>
                                    <option value="09:00:00">09h</option>
                                    <option value="10:00:00">10h</option>
                                    <option value="11:00:00">11h</option>
                                    <option value="12:00:00">12h</option>
                                    <option value="13:00:00">13h</option>
                                    <option value="14:00:00">14h</option>
                                    <option value="15:00:00">15h</option>
                                    <option value="16:00:00">16h</option>
                                    <option value="17:00:00">17h</option>
                                    <option value="18:00:00">18h</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="heure_fin">Heure de fin :</label>
                                <select name="heure_fin" required>
                                    <option value="09:00:00">09h</option>
                                    <option value="10:00:00">10h</option>
                                    <option value="11:00:00">11h</option>
                                    <option value="12:00:00">12h</option>
                                    <option value="13:00:00">13h</option>
                                    <option value="14:00:00">14h</option>
                                    <option value="15:00:00">15h</option>
                                    <option value="16:00:00">16h</option>
                                    <option value="17:00:00">17h</option>
                                    <option value="18:00:00">18h</option>
                                    <option value="19:00:00">19h</option>
                                </select>
                            </div>
                        </div>
                        <div class="row block mb-3 my-5">
                            <button class="form-control submit" width="100%" type="submit" name="submit">RESERVER</button>
                        </div>

                        <?php }
                        else
                        {
                            echo '<a class="lead" href="connexion.php">Connectez-vous pour réserver</a>';
                        } ?>

                    </form>
                </article>

                <!-- Encart droite -->
                <article class="col-md my-3 h-100 bg-light">
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">Un espace clé en main pour vos réunions</h5>
                            <p class="card-text">La salle est équipée en fonction de vos demandes. VIDÉOPROJECTEUR, ÉCRAN DE PROJECTION, WIFI 4G/5G et tableau disponibles par défaut.<br><span class="text-alert">N'oubliez pas de détailler le matériel désiré dans la description de votre réservation.</span><br>
                            Des supports papier et stylos sont gracieusement mis à votre disposition.  </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Réservation du lundi au vendredi</li>
                            <li class="list-group-item">La veille au plus tard</li>
                            <li class="list-group-item">De 8h à 19h</li>
                            <li class="list-group-item">Créneau fixe d'une heure</li>
                            <li class="list-group-item">Horaire max/réservation : 1h<br>
                            <small>pour réserver plusieurs heures succéssives, il suffit de réserver chaque heure.</small></li>

                        </ul>
                        <div class="card-body py-3">
                            <a href="planning.php" class="card-link">Voir le planning</a>
                        </div>
                    </div> <!-- /card -->
                </article>
            </div> <!-- /row -->


            <?php 

                if (isset($_POST['titre']) && isset($_POST['date']) && isset($_POST['heure_debut']) && isset($_POST['heure_fin']) && isset($_POST['description'])){
                    $titre = mysqli_real_escape_string($conn, htmlspecialchars($_POST['titre']));
                    $date = $_POST['date'];
                    $heure_d = $_POST['heure_debut'];
                    $heure_f = $_POST['heure_fin'];
                    $date_d = [$date, $heure_d];
                    $date_d = implode(" ", $date_d);
                    $date_f = [$date,$heure_f];
                    $date_f = implode(" ", $date_f);
                    $description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['description']));
                    // Test pour vérifier si la date choisie est un week-end
                    $date = date("w", strtotime($date));
                    if ($date == 0 || $date == 6){
                        echo '<p class="red">Il n\'y a pas de réservation le week-end, veuillez choisir une autre date</p>';
                        exit();
                    }
                    // Test pour vérifier que le créneau soit bien de 1h min
                    if ($heure_d >= $heure_f)
                    {
                        echo '<p class="red">Le créneau doit être d\'au moins 1h, ou l\'heure de début doit être antérieure à l\'heure de fin</p>';
                        exit();
                    }
                    // Test pour vérifier la disponibilité de la réservation
                    $test = "SELECT COUNT(*) FROM `reservations` WHERE debut<= '$date_d' AND '$date_d' < fin OR debut< '$date_f' AND '$date_f'<=fin";
                    $result = mysqli_query($conn, $test);
                    $reponse = mysqli_fetch_array($result);
                    $count = $reponse['COUNT(*)'];
                    if ($count == 0)
                    {
                        $id = $_SESSION['id']; 
                        $sql = "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES ('$titre', '$description', '$date_d', '$date_f', $id)";
                        $result = mysqli_query($conn, $sql);
                        if ($result){
                            echo '<h3 class="green lead">Réservation effectuée</h3>';
                        } else {
                            echo '<h3 class="red lead">Erreur</h3>';
                        }
                    }
                    else {
                        echo '<p class="red lead">Créneau déjà pris</p>';
                    }
                }

            ?>

        </div> <!-- /container -->
    </main> <!-- main -->

<?php include("includes/footer.php")?>
