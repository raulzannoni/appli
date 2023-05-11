<?php
    session_start();
    ob_start();

    if(isset($_SESSION['message']))
        {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }

    echo "<div id='wrapper'>",
            "<h1>Récapitulatif des produits</h1>";
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
    </div>

   

    <?php

    $content = ob_get_clean();
    $titre = "Récap";
    require "template.php";