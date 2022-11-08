<?php
include("headerMagasin.php");

foreach ($articles as $article) {
  $image = getImagesArticles($article);
  echo $article["pr_nom"]."<img src='". $image["ph_chemin"] ."'> ";
}



 ?>
