<?php

include "../Model/commandes.php";

$result = getInfoArticle();
$idProduit = $_GET['id'];
$resultGP = getPhotosProduit($result);
$DispoMagasin = getStockMagasin($idProduit);
$stockInternet = getStockInternet($idProduit);

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