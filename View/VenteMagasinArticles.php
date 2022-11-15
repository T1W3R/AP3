<style>
  .produits{
    display: flex;
  }
  .produit {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 30px;
    margin: auto;
    text-align: center;
}
</style>

<?php
include("headerMagasin.php");
echo "<div class='produits'>";
foreach ($articles as $article) {
  $image = getImagesArticles($article);
  echo "<div class='produit'>
  <form action='../Controller/VenteMagasinArticles.php' method='post'>
  <img width='400px' src='". $image["ph_chemin"] ."'>
  <br>".$article["pr_nom"]."<br>
  <label for='quantite'>Quantitée: </label><br><input id='quantite' type='number' name='quantite'>
  <input type='hidden' name='id' value='".$article["pr_reference"]."'>
  <br><br>
  <button type='submit'>Ajouter au panier</button>
  </form>
  </div> ";
}

echo "</div>";


 ?>
