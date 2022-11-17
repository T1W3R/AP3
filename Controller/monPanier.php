<?php
session_start();

include("../Model/commandes.php");




//Avoir le prix total de chaque(s) article(s)
function GetPrixTotal($prix, $quantite)
{
    $prixTTC = $prix * intval($quantite);
    $prixTTC = number_format((float)$prixTTC, 2, '.', '');
    return $prixTTC;
}

function getPrixTTC($infos){
    $prix = $infos["pr_coutHT"]*1.20;
    $prix = number_format((float)$prix, 2, '.', '');
    return $prix;
}

// Avoir toutes les commandes passées.
$infosCl = getIdClient();
$infosCo = getInfoCommande($infosCl);
$resultGCo = getAllCommandes($infosCl);

include("../View/monPanier.php");
