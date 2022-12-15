<!-- PLANNING PAGE -->

<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?> <!--connexion à la base de données-->

<?php

    //var_dump($_SESSION);
    $conn = mysqli_connect("localhost", "root","","reservationsalles");
    $requete = "SELECT u.id , u.login , r.titre , r.description , r.debut , r.fin FROM utilisateurs AS u INNER JOIN reservations AS r ON u.id = r.id_utilisateur";
    $query = mysqli_query($conn,$requete);
    $resultat = mysqli_fetch_all($query);
    //var_dump($resultat);
    $format= date('Y-m-d  H');
    $requetedate = "SELECT debut,titre,id FROM reservations";
    $querydate = mysqli_query($conn, $requetedate);
    $resultatdate = mysqli_fetch_all($querydate);
    $tableaudatecount = count($resultatdate);
    
    //echo $format;
    //var_dump($resultatdate);
    $stopitnow = false;
    $stopnope = false;
?>


<main role="main">
    <div class="container my-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center table-borderless">
                <?php
                    $login = $_SESSION['login'];
                    $jourssemaine = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                    $j = 0;
                    $h = 8;
                    $jourscases = 0;
                    echo '<thead class="table-light"><tr>';
                    echo "<th></th>";
                    
                    while($j < 7) {
                        echo "<th>".$jourssemaine[$j]."</th>";
                        $j++;
                    }
                    echo '</tr></thead>';
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
                                
                                //var_dump($tableaudatecount);
                                if($datejour == $jourscases && $dateheure == $h)
                                {
                                    echo "<td id='reserved'> ".$titreres."<br> par : ".$login." <br><a href='reservation.php?id=".$idres."'>voir</a> </td>";
                                    $stopnope = true;
                                }
                                else {
                                    $stopitnow = false;
                                }

                                        
                                $r++;
                                        
                            }

                            if ($stopitnow == false  && $stopnope == false)
                            {
                                echo "<td id='dispo'><a href='reservation-form.php'>Libre </a></td>";
                            } 
                            $r = 0;
                            $jourscases++;
                            $stopitnow = false;
                            $stopnope = false;
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
