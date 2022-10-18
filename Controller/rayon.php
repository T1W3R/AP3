<?php

include("../Model/commandes.php");

$rayon = $_GET["id"];
$ray = getRayons();
$res = getProduitsByRayon($rayon);

include("../View/rayon.php");
