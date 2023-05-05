<?php
    //il faiut de parcourir le tableau de session, 
    //il est donc necessaire d'appeler la fonction session_start() en debut de fichier afin de recuperer
    //la session correspondante à l'utilisateur
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <?php 
    //pour assurer que le tableau de session contienne des informations à afficher
    //var_dump($_SESSION);
    
    //Ajoute de deux conditions:
    //1) si le clé "products" du tableau de $_SESSION n'existe pas: !isset()
    //2) si cette clé existe mais ne contient aucune donnée: empty
    if(!isset($_SESSION['products']) || empty($_SESSION['products']))
        {
            echo "<p>Aucun produit en session...</p>";
        }

    //sinon, on va à afficher le contenu de $_SESSION['products'] dans un tableau HTML <table>
    else    
        {
            echo    "<table>",
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
                                "<td>".$index."</td>",
                                "<td>".$product['name']."</td>",
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                "<td>".$product['qtt']."</td>",
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
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
</body>
</html>