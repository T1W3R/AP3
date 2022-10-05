<?php

include("../Model/commandes.php");

$result = SelectProduits();

include("../View/index.php");