<?php
session_start();

if (isset($_SESSION["login"])) {
    include("../View/header_connected.php");
} else {
    include("../View/header_unconnected.php");
};
 ?>
<div class="">
  <center>
    <h1>Liste de nos magasins et entrepôts</h1>
    <img src="../images/carte_implantation.png" alt="Carte de nos magasins et entrepôts" width="800px">
    <p>🔴 Nos magasins</p>
    <p>🟡 Nos entrepôts</p>
  </center>
</div>
