<?php

    include("../Model/VenteMagasin.php");

    if (isset($_POST["Login"]) && isset($_POST["Mdp"])) {
      $login = $_POST["Login"];
      $mdp = $_POST["Mdp"];
      $log = logMagasin($login, $mdp);
      $_SESSION["login"] = $log;
    } else {
      include("../View/VenteMagasin.php");
    }




?>
