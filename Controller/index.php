<?php

include("../Model/commandes.php");

$res = getProduits();

include("../View/index.php");