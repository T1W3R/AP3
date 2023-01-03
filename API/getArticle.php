<?php

include ("../Model/api.php");

echo json_encode(getArticle($_GET["id"]));
echo json_encode(array("lieux" => getLieuArticle($_GET["id"])));
$chemin = getPhotos($_GET["id"])[0];
$chemin = str_replace("..","",$chemin);
echo json_encode(array("photo" => "/SLAM/AP3/AP3".$chemin));


 ?>
