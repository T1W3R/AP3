<?php
if (session_status() === PHP_SESSION_NONE) {
    include "header_unconnected.php";
} else {
    include "header_connected.php";
};
?>
<div style="background-color: #c1B89F; padding-top: 8vw;">
    <div style="background-color: #B19D7F; color: aliceblue; padding-left: 4vw; padding-right: 4vw; padding-top: 3vw; padding-bottom: 1vw; border-radius: 2vw; margin-left: 2vw; margin-right: 2vw;">
        <center>
            <img src="images/tiny_logo.png" alt="tiny_logo" height=50vw>
            <h1>Veuillez vous connectez :</h1>
            <div style="display : flex; justify-content: center;">
                <p>Si vous ne possedez pas de compte, cliquez sur </p>
                <p style="color: #B19D7F;">i</p> <a href="inscription.php"> S'inscrire</a>
            </div>
        </center>

        <form method="POST" action="traitementconnexion.php">
            <div class="mb-3 row">
                <label for="inputpseudo" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPseudo" placeholder="email@example.com" name="mail">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe :</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Mot de passe" name="mdp">
                </div>
            </div>
            <div class="col-auto" style="text-align: center; margin-top: 2vw;">
                <button type="submit" class="btn btn-primary mb-3" style="background-color: #B19D7F; border-color: aliceblue; color: aliceblue;">Se connecter</button>
            </div>
        </form>
    </div>
</div>
</body>

</html>