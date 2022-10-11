<?php
session_start();

include("../Model/commandes.php");

$infosCl = getIdClient();
$infosCo = getInfoCommande($infosCl);

//Avoir le prix total de chaque(s) article(s)
function GetPrixTotal($res){
    $prixTTC = ($res["pr_coutHT"] * 1.20) * $res["pr_quantite"];
    $prixTTC = number_format((float)$prixTTC, 2, '.', '');
    return $prixTTC;
}

// Avoir toutes les commandes passées.
$resultGCo = getAllCommandes($infosCl);

include("../View/monPanier.php");