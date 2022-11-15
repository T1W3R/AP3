<?php
session_start();

include("../Model/commandes.php");




//Avoir le prix total de chaque(s) article(s)
function GetPrixTotal($infos, $quantite)
{
    $prixTTC = ($infos["pr_coutHT"] * 1.20)*$quantite;
    $prixTTC = number_format((float)$prixTTC, 2, '.', '');
    return $prixTTC;
}

// Avoir toutes les commandes passées.
$infosCl = getIdClient();
$infosCo = getInfoCommande($infosCl);
$resultGCo = getAllCommandes($infosCl);

include("../View/monPanier.php");
