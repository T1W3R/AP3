<?php
    if (session_status() === PHP_SESSION_NONE){
        include "header_unconnected.php";
    } else {
        include "header_connected.php";
    };
?> 

    <div style="background-color: #c1B89F; padding-top: 2vw; padding-bottom: 2vw;">
        <div style="background-color: #B19D7F; color: aliceblue; padding-left: 4vw; padding-right: 4vw; padding-top: 1vw; padding-bottom: 0.5vw; border-radius: 2vw; margin-left: 2vw; margin-right: 2vw;">
            <center>
                <img src="images/tiny_logo.png" alt="tiny_logo" height= 50vw>
                <h1>Inscription:</h1>
                <div style="display : flex; justify-content: center;">
                    <p>Vous êtes nouveaux sur notre site, veuillez renseignez ces données.</p><p style="color: #B19D7F;">i</p><a href="connexion.php"> Retour</a>
                </div>
            </center>

            <form method="POST" action="traitementinscription.php">
                <div class="mb-3 row">
                    <label for="inputnom" class="col-sm-2 col-form-label">Nom :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputNom" placeholder="Nom" name="nom" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputprenom" class="col-sm-2 col-form-label">Prenom :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPrenom" placeholder="Prenom" name="prenom" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputpseudo" class="col-sm-2 col-form-label">Pseudo :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPseudo" placeholder="Pseudo" name="pseudo" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputadress" class="col-sm-2 col-form-label">Adresse :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAdress" placeholder="623 rue du boulevard Paris" name="adress" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputemail" class="col-sm-2 col-form-label">Email :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="email@example.com" name="mail" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe :</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Mot de passe" name="mdp" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Confirmation de mot de passe :</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Confirmation du mot de passe" name="cmdp" required>
                    </div>
                </div>
                <div class="col-auto" style="text-align: center;">
                    <button type="submit" class="btn btn-primary mb-3" style="background-color: #B19D7F; border-color: aliceblue; color: aliceblue;">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>