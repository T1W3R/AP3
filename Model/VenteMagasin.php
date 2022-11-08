<?php
include("bdd.php");
function logMagasin($login, $mdp){
  $sql = "SELECT ma_login FROM `magasin` WHERE ma_login = '".$login."' AND ma_mdp = '".$mdp."';";
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





?>
