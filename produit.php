<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Page produit</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    </head>
    <body>
        <?php 
            if(isset($_GET["id"])){
                function getConnexion(){
                    $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';
                  
                    try {
                        $bdd = new PDO($dsn, "root", "");
                        return $bdd;
                    } catch (PDOExeption $e) {
                        die('DB Error: '.$e->getMessage());
                    }
                  } 
                    //Avoir les infos de l'article 
                    $sql = "SELECT pr_id, pr_nom, pr_coutHT, pr_description FROM `produit` WHERE pr_id=".$_GET['id'];
                    $bdd = getConnexion();
                    $query = $bdd->prepare($sql);
                    $query->execute();
                    $result = $query->fetch();
            
                    //Avoir les photos
                    $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = ".$result['pr_id']."; ";
                    $queryGP = $bdd->prepare($getPhoto);
                    $queryGP->execute();
                    $resultGP = $queryGP->fetchAll();

                    //Calcul prix total
                    $prixTTC = $result["pr_coutHT"] + 0.20*$result["pr_coutHT"];
                    $prixTTC = number_format((float)$prixTTC, 2, '.', '');

                    //Affichage produit 
                    echo "<p>".$result["pr_nom"]."<br>".$result["pr_description"]."<br>".$result['pr_coutHT']." € HT<br>+20% TVA<br>".$prixTTC." € TTC</p>";
                    foreach($resultGP as $resGP){
                        echo "<img src='".$resGP[0]."' width = '350px', height='350px'>";
                    }
                    
                    
            } else{
                header ("Location: http://localhost/SLAM/AP3/AP3/");
                exit;
            }
        
        
        
        
        ?>
    </body>
</html>