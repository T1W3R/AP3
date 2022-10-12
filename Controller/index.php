<?php

include("../Model/commandes.php");

$ray = getRayons();
$res = getProduits();

include("../View/index.php");
