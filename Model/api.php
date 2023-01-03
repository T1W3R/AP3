<?php

include("../Model/bdd.php");

function connexion($login, $mdp){
  $sql = "SELECT cl_email, cl_nom, cl_prenom, cl_adresse, cl_id FROM `client` WHERE cl_email = '". $login ."' AND cl_mdp = '".$mdp."';";
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  return $result;
}

function getArticle($id){
$sql = "SELECT pr_nom, pr_description, pr_stockInternet, ma_lieu FROM `produit` JOIN a_en_stock AS stock ON pr_reference = stock.fk_pr JOIN magasin ON ma_id = fk_ma WHERE pr_reference = ". $id ." LIMIT 1";
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  return $result;
}

function getLieuArticle($refProduit){
  $sql="SELECT  ma_lieu FROM `produit` JOIN a_en_stock ON pr_reference = fk_pr JOIN magasin ON ma_id = fk_ma WHERE pr_reference = ".$refProduit;
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetchAll();

  return $result;
}

function getPhotos($id){
  $sql="SELECT ph_chemin FROM `photos` WHERE fk_pr = ".$id." LIMIT 1;";
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  return $result;
}

 ?>
