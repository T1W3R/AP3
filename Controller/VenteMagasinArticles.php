<?php

var_dump( $_POST);
$_SESSION["panier"] = [];
$_SESSION["panier"] += ["1" => "test"];
$_SESSION["panier"] += ["2" => "test"];

echo "<br>";

foreach ($_SESSION["panier"] as $key => $value) {
  echo $key." => ". $value." <br>";
}

var_dump( $_SESSION);

 ?>
