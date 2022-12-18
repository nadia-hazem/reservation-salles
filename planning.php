<!-- PLANNING PAGE -->

<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?> <!--connexion à la base de données-->

<?php
    //var_dump($_SESSION);
    $requete = "SELECT u.id , u.login , r.titre , r.description , r.debut , r.fin FROM utilisateurs AS u INNER JOIN reservations AS r ON u.id = r.id_utilisateur";
    $queryevent = mysqli_query($conn,$requete);
    $resultat = mysqli_fetch_all($queryevent);
    //var_dump($resultat);
    $format= date('Y-m-d  H');
    $requetedate = "SELECT reservations.debut, reservations.titre,reservations.id, utilisateurs.login FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id";
    $querydate = mysqli_query($conn, $requetedate);
    $resultatdate = mysqli_fetch_all($querydate);
    $tableaudatecount = count($resultatdate);
    
    //echo $format;
    /* var_dump($resultatdate); */
    /* die(); */
    $stopitnow = false;
    $stopnope = false;
?>


<main role="main">
    <div class="container my-5 shadow">
        <div class="table-responsive">

            <table class="table table-hover align-middle text-center table-borderless table-sm">
                
                <?php
                    date_default_timezone_set('Europe/Paris');
                    $jourssemaine = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                    $today = date("w"); //représentation numérique du jour (Lundi = 1)

                    for ($i = 0; $i < 6; $i++) { //Récupération du numéro des jours de la semaine en cours
                        $thisweek[$i] = date("d", mktime(0, 0, 0, date("n"), date("d") - $today + $i, date("y")));
                    } 

                    $j = 0;
                    $h = 8;
                    $jourscases = 0;

                    ?>
                    <h1>Planning <?php echo $jour_semaine = date('Y', time());?></h1>
                    <div class="float-right"><a href="inscription.php" class="btn btn-primary">S'inscrire</a></div>
                    <div class="float-right"><a href="connexion.php" class="btn btn-primary">Connexion</a></div>
                    <h2>Semaine <?php echo $jour_semaine = date('W', time());?></h2>

                    <table class="table table-condensed" style="table-layout: fixed">
                    
                <?php
                    echo '<thead class="table-light"><tr>';
                    ?>
                    <tr>
                        <th class="vide"></th>
                        <th class="jour">Lun. <?php echo $jour_semaine = date('d/m', strtotime('monday this week'));?></th>
                        <th class="jour">Mar. <?php echo $jour_semaine = date('d/m', strtotime('tuesday this week'));?></th>
                        <th class="jour">Mer. <?php echo $jour_semaine = date('d/m', strtotime('wednesday this week'));?></th>
                        <th class="jour">Jeu. <?php echo $jour_semaine = date('d/m', strtotime('thursday this week'));?></th>
                        <th class="jour">Ven. <?php echo $jour_semaine = date('d/m', strtotime('friday this week'));?></th>
                        <th class="vide">Sam. <?php echo $jour_semaine = date('d/m', strtotime('saturday this week'));?></th>
                        <th class="vide">Dim. <?php echo $jour_semaine = date('d/m', strtotime('sunday this week'));?></th>
                    </tr>                              
                </thead>
                <tbody> 
                    <?php
                        echo "<tbody>"; //TBODY

                        while($h != 20) {
                            $resok = false;
                            echo "<tr>";
                            if($jourscases == 0)
                            {
                                echo "<td id='tdheure'><b>".$h."h</b></td>";
                                $jourscases++;
                            }
                            $r = 0;
                                
                            $jourscases = 1;
                            while($jourscases < 8 && $jourscases != 0)
                            {
                                while($r < $tableaudatecount)
                                {
                                    $stopitnow = true;
                                    $dateheure = date("G", strtotime($resultatdate[$r][0]));
                                    $datejour = date("N", strtotime($resultatdate[$r][0]));
                                    $titreres = $resultatdate[$r][1];
                                    $idres = $resultatdate[$r][2];
                                    $login = $resultatdate[$r][3];
                                    
                                    //var_dump($tableaudatecount);

                                    if($datejour == $jourscases && $dateheure == $h)
                                    {   $extrait_titre = substr($titreres, 0, 16);
                                        $extrait_login = substr($login, 0, 10);
                                        echo "<td class='resa text-wrap' id='reserved'> <b>".$extrait_titre.".</b><br> par ".$extrait_login.".<br><a href='reservation.php?id=".$idres."'><i class='fa-solid fa-2x fa-eye'></i></a></td>";
                                        $stopnope = true;
                                    }
                                    else {
                                        $stopitnow = false;
                                    }

                                            
                                    $r++;
                                            
                                }
                                if ($stopitnow == false  && $stopnope == false)
                                {
                                    echo "<td id='dispo'><a href='reservation-form.php'>Libre</a></td>";
                                    if($jourscases == 5) {
                                        echo "<td id='closed'>fermé</td>";
                                        $jourscases++;
                                    }
                                    if($jourscases == 6) {
                                        echo "<td id='closed'>fermé</td>";
                                        $jourscases++;
                                    }
                                } 
                                $r = 0;
                                $jourscases++;
                                $stopitnow = false;
                                $stopnope = false;
                                if ($jourscases == 8)
                                {
                                    $jourscases = 0;
                                }
                            }
                            // CREER UNE NOUVELLE BOUCLE POUR AFFICHER DANS LES TD ET PAS FAIRE UNE BOUCLE SEULEMENT POUR AFFICHER UN TD
                            echo "</tr>";
                            $jourscases = 0;
                            $h++;
                            
                        }
                    
                        
                        echo '</tbody>';
                        
                    
                ?>
            </table>
        </div>
    </div>
</main>

<?php include("includes/footer.php")?>