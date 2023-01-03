<?php
  session_start();
    include("../Model/VenteMagasin.php");

    if (isset($_POST["Login"]) && isset($_POST["Mdp"])) {
      $login = $_POST["Login"];
      $mdp = $_POST["Mdp"];
      $log = logMagasin($login, $mdp);

      if ($log == false) {
        echo "erreur de login";
        include("../View/VenteMagasin.php");
      } else {
        $_SESSION["login"] = $log["ma_login"];

        $articles = getArticles($log["ma_id"]);
        include("../View/VenteMagasinArticles.php");
      }

    } elseif (isset($_SESSION["login"])) {
      if (isLoggedMagasin($_SESSION["login"]) != false) {
        $articles = getArticles(isLoggedMagasin($_SESSION["login"])["ma_id"]);
        include("../View/VenteMagasinArticles.php");
      } else {
        include("../View/VenteMagasin.php");
      }
    } else {
      include("../View/VenteMagasin.php");
    }




?>
