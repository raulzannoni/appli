<?php
    //il faut de parcourir le tableau de session, 
    //il est donc necessaire d'appeler la fonction session_start() en debut de fichier afin de recuperer
    //la session correspondante à l'utilisateur
    session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <h1>Récapitulatif des produits</h1>
    <?php 
    //pour assurer que le tableau de session contienne des informations à afficher
    //var_dump($_SESSION);
    
    //Ajoute de deux conditions:
    //1) si le clé "products" du tableau de $_SESSION n'existe pas: !isset()
    //2) si cette clé existe mais ne contient aucune donnée: empty
    if(!isset($_SESSION['products']) || empty($_SESSION['products']))
        {
            echo "<p id='panierVide'>Aucun produit en session...</p>";
        }

    //sinon, on va à afficher le contenu de $_SESSION['products'] dans un tableau HTML <table>
    else    
        {
            echo    "<table id='list'>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "</tr>",
                        "</thead>",
                        "<tbody>";

            //instruction pour permettre l'affichage uniforme de chque produit
            //$index: clé du tableau$_SESSION["products"] parcouru (c'est possible numerotér le produit dans le tableau HTML)
            //$product: variable conteinent le produit, sous forme de tableau, tel que l'a créé et stoché en session le fichier traitement.php
            
            //on initialise une nouvelle variable à zero
            $totalGeneral = 0;
            
            foreach($_SESSION["products"] as $index => $product)
                {
                    //la fonction PHP number_format() permet de modifier l'affichage d'une valeur numerique en precisant plusiers paramètres
                    //number_format(variable à modifier, nombre de decimales souhaité, caractere separateur decimal, caractere separateur de milliers)
                    echo    "<tr>",
                                "<td>".$index + 1 ."</td>",
                                "<td>".$product['name']."</td>",
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                "<td>".$product['qtt']."</td>",
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                "<td><button id='modifier1' type='submit' form='formRecap' formaction='traitement.php?action=addQuantity&id=".$index."'><i class='fas fa-plus'></i></button></td>",
                                "<td><button id='modifier2' type='submit' form='formRecap' formaction='traitement.php?action=deleteQuantity&id=".$index."'><i class='fas fa-minus'></i></button></td>",
                                "<td><button id='modifier3' type='submit' form='formRecap' formaction='traitement.php?action=removeProduct&id=".$index."'><i class='fas fa-trash-alt'></i></button></td>",
                            "</tr>";
                    //pour couvrir le chaier des charges au complet
                    $totalGeneral += $product['total'];
                }
            
            //on affiche un ligne avante de fermer notre tableau. Deux cellules:
            //1) une cellule fusionnée de 4 cellules (coldspan=4) pour l'intitulé
            //2) une cellule affichant le contenu formaté de $totlGeneral avec number_format()    
            echo            "<tr>",
                                "<td coldspan=4>Total général : </td>",
                                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                            "</tr>",
                        "</tbody>", 
                    "</table>";
        }
    ?>

    
    <form id="formRecap" method="post">
    <!-- Bouton pour changer la page -->
        <button type=submit formaction='traitement.php?action=index' id="btnIndex">Ajouter un produit</button>

    <!-- Bouton pour supprimer tous les produits -->
        <button type=submit formaction='traitement.php?action=removeAll' id="btnRemoveAll">Supprimer tous les produits</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>