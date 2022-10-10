<?php
session_start();
if (session_status() === PHP_SESSION_NONE) {
    include "../View/header_unconnected.php";
} else {
    include "../View/header_connected.php";
};

include "../Model/commandes.php";

$result = getInfoArticle();

$resultGP = getPhotosProduit($result);

$DispoMagasin = getStockMagasin($_GET['id']);



if (isset($_GET["id"])) {
    //Calcul prix total
    $prixTTC = $result["pr_coutHT"] + 0.20 * $result["pr_coutHT"];
    $prixTTC = number_format((float)$prixTTC, 2, '.', '');

    //Affichage produit 
    include "../View/produit.php";
} else {
    header("Location: http://localhost/SLAM/AP3/AP3/");
    exit;
}




?>
</body>

</html>