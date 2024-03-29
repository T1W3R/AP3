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
.panier {
  position: fixed;
  bottom: 50px;
  max-height: 150px;
  border-top: 1px solid white;
  overflow: auto;
  width: 99%;
}

.formPanier {
  position: fixed;
  bottom: 50px;
  right: 40px;
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
  <label for='quantite'>Quantitée: </label><br>
  <input id='quantite' type='number' min='1' name='quantite' value=1>
  <input type='hidden' name='id' value='".$article["pr_reference"]."'>
  <br><br>
  <button type='submit'>Ajouter au panier</button>
  </form>
  </div> ";
}

echo "</div><div class='panier'>
<h1>Panier en cours</h1>";
  if (isset($_SESSION["panier"])) {
    foreach ($_SESSION["panier"] as $key => $value) {
      echo getArticleById($key).", quantité: ". $value." <br>";
    }
    ?>
    <form class="formPanier" action="ValidationPanierMagasin.php" method="post">
      <label for="client">Email du client s'il veut se connecter:</label>
      <input type="text" name="client" id="client">
      <button type="submit" name="button">Valider panier</button>
    </form>

    <?php

  } else {
    echo "La panier est pour l'instant vide";
  }
echo "</div>";
 ?>
