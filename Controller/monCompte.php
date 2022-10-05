<?php

session_start();

include ("../Model/commandes.php");

$res = SelectInfos();

include ("../View/monCompte.php");

