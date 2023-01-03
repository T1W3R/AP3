<?php

include("../Model/api.php");

if (isset($_GET["login"]) && isset($_GET["mdp"])) {
  $login = connexion($_GET["login"], hash("sha512",$_GET["mdp"]));
  if ($login != false){
    echo json_encode($login);
  } else {
    echo json_encode(["cl_email"=>false]);
  }
}



 ?>
