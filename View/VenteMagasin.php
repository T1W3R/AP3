<?php
  include("headerMagasin.php")
?>
<style media="screen">
  input{
    width: 500px;
    text-align: center;
  }
</style>

<form action="../Controller/VenteMagasin.php" method="post">
  <center>
    <label for="login">Identifiant:</label><br>
    <input type="text" name="Login" id="login" placeholder="Entrer votre identifiant magasin ici">

    <br><br>

    <label for="Mdp">Mot de passe:</label><br>
    <input type="text" name="Mdp" id ="Mdp" placeholder="Entrer votre mdp magasin ici">

    <br><br>

    <button type="submit" name="button">Se connecter</button>
  </center>
</form>

<?php

?>
