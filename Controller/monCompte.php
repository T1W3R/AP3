<?php
session_start();

include ("../Model/commandes.php");

$res = getInfos();

include ("../View/monCompte.php");

