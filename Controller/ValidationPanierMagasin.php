<?php

session_start();
include("../Model/VenteMagasin.php");

if ($_POST["client"] != "") {
  $idClient = $_POST["client"];
} else {
  $idClient = getIdClientMagasin($_SESSION["login"])[0];
}

//creer une commande
$prixTotal = 0;
foreach ($_SESSION["panier"] as $key => $value) {
  $prixTotal += getPrixProduit($key) * $value * 1.20 ;
}
$prixTotal = round($prixTotal, 2);
InsertCommande($prixTotal, $idClient);

//creer recuperer l'id de la commande
$idCommande = getIdCommandeMagasin($idClient);

//inserer dans les lie a
foreach ($_SESSION["panier"] as $ref => $quantite) {
    InsertProduitsCommande($idCommande, $ref, $quantite);
}

unset($_SESSION['panier']);

header('Location: http://localhost/SLAM/AP3/AP3/Controller/VenteMagasin.php');
exit();




 ?>
