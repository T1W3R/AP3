<?php

include ("../Model/api.php");

$chemin = getPhotos($_GET["id"])[0];
$chemin = str_replace("..","",$chemin);
$tab = array(getArticle($_GET["id"]), "photo" => "/SLAM/AP3/AP3".$chemin, array("lieux" => getLieuArticle($_GET["id"])));
echo json_encode($tab);



 ?>
