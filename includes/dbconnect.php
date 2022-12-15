<!--DBCONNECT BLOC-->
<?php // connexion à la base de données

$conn = mysqli_connect('localhost', 'root', '', 'reservationsalles'); 
/* $conn = mysqli_connect('localhost', 'nadia', '*moduleconnexion*', 'nadia-hazem_reservationsalles');
*/
if(!$conn) {
    echo "Connexion non établie.";
    exit;
}
?>
