<?php
    //il faut de parcourir le tableau de session, 
    //il est donc necessaire d'appeler la fonction session_start() en debut de fichier afin de recuperer
    //la session correspondante à l'utilisateur
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="style.css">
        <title>Ajout produit</title>
    </head>
    <body>
        <?php 
        $nb_products = 0;
            if(!isset($_SESSION['products']) || empty($_SESSION['products']))
                {
                    $nb_products = 0;
                }

            else    
                {
                    $nb_products = count($_SESSION['products']);
                }
        ?>
        <h1>Ajouter un produit</h1>
        <!-- 2 attributes: -->
        <!-- action: le fichier à atteindre lorsque l'utilisateur soumettra le formulaire -->
        <!-- method: quelle methode HTTP les données du formulaire seront transmises au serveur -->
        <!-- POST: pour ne pas "polluer" l'URL avec les données du formulaire --> 
        <form action="traitement.php?action=addProduct" method="post">
            <p>
                <label>
                    Nom du produit:
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit:
                    <input type="number" step= "any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité desirée:
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>

            <!-- Notification du nombre de produits ajoutés -->
            <p id="nombreProducts">Nombre de produits ajouté: <?=$nb_products?></p>

             <!-- Bouton pour changer la page -->
            <button formaction='traitement.php?action=recap' method="post" id="btnRecap">Consulter le panier</button>

        </form>
    

    

   
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>    
    </body>
</html>