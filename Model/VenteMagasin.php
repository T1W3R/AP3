<?php
include("bdd.php");
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






?>
