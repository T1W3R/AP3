<?php
session_start();

include "../Model/commandes.php";

$idProduit = $_POST['idProduit'];
$quantite = $_POST['quantite'];


if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

$_SESSION["panier"] += [$idProduit => $quantite];

header('Location: MonPanier.php');
exit();

 ?>