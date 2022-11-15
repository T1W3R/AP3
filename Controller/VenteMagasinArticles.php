<?php
session_start();
var_dump( $_POST);
if (!isset($_SESSION["panier"])) {
  $_SESSION["panier"] = [];
}
if (isset($_SESSION["panier"][$_POST["id"]])) {
  $_SESSION["panier"][$_POST["id"]] +=  $_POST["quantite"];
} else {
  $_SESSION["panier"] += [$_POST["id"] => $_POST["quantite"]];
}


echo "<br>";

foreach ($_SESSION["panier"] as $key => $value) {
  echo $key." quantité: ". $value." <br>";
}

var_dump( $_SESSION);

header('Location: VenteMagasin.php')

 ?>
