<?php
include("../Model/commandes.php");

function logMagasin($login, $mdp){
  $sql = "SELECT ma_login, ma_id FROM `magasin` WHERE ma_login = '".$login."' AND ma_mdp = '".$mdp."';";
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  if ($result != "none") {
    return $result;
  } else {
    return false;
  }
}

function isLoggedMagasin($login){
  $sql = "SELECT ma_login, ma_id FROM `magasin` WHERE ma_login = '".$login."'";
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  if ($result != "none") {
    return $result;
  } else {
    return false;
  }
}

function getArticles($ma_id){
      $sql = "SELECT pr_nom, pr_reference, pr_reference
              FROM produit
              	JOIN a_en_stock ON pr_reference = fk_pr
              WHERE fk_ma = ". $ma_id .";";
      $bdd = construct_();
      $query = $bdd->prepare($sql);
      $query->execute();
      $result = $query->fetchAll();

      return $result;

}

function getImagesArticles($article){
    $sql = "SELECT ph_chemin
            FROM photos
            	JOIN produit ON pr_reference = fk_pr
            WHERE fk_pr = ". $article["pr_reference"] ."
            LIMIT 1;";
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetch();

    return $result;
}

function getArticleById($id){
  $sql = "SELECT pr_nom FROM `produit` WHERE pr_reference = '".$id."'";
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  return $result["pr_nom"];
}

function getPrixProduit($ref){
  $sql = 'SELECT pr_coutHT FROM `produit` WHERE pr_reference = "'. $ref .'";';
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  return $result["pr_coutHT"];
}

function getIdClientMagasin($login){
  $sql = "SELECT ma_idClient FROM magasin WHERE ma_login = '". $login . "'";
  $bdd = construct_();
  $query = $bdd->prepare($sql);
  $query->execute();
  $result = $query->fetch();

  return $result;
}

function getIdCommandeMagasin($idClient){
  $getIdCommande = "SELECT co_id FROM `commande` WHERE fk_cl = ". $idClient ." ORDER BY co_id DESC LIMIT 1;";
  $bdd = construct_();
  $queryIC = $bdd->prepare($getIdCommande);
  $queryIC->execute();
  $resultIC = $queryIC->fetch();
  return $resultIC;
}






?>
