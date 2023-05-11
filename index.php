<?php
    //il faut de parcourir le tableau de session, 
    //il est donc necessaire d'appeler la fonction session_start() en debut de fichier afin de recuperer
    //la session correspondante à l'utilisateur
    session_start();

    //demarre l'output avant qu'il est envoyé au serveur
    ob_start();

        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
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
        <div id=wrapper>
            <div id=form>
                <h1>Ajouter un produit</h1>
                <!-- 2 attributes: -->
                <!-- action: le fichier à atteindre lorsque l'utilisateur soumettra le formulaire -->
                <!-- method: quelle methode HTTP les données du formulaire seront transmises au serveur -->
                <!-- POST: pour ne pas "polluer" l'URL avec les données du formulaire --> 
                <form action="traitement.php?action=addProduct" method="post" enctype="multipart/form-data">
                    <p>
                        <label>
                            Nom du produit:
                            <input id="inputText" type="text" name="name">
                        </label>
                    </p>
                    <p>
                        <label for="file">
                            Fichier du produit:
                        </label>
                            <input id="inputFile" type="file" name="file">
                    </p>
                    <p>
                        <label>
                            Prix du produit:
                            <input id="inputText" type="number" step= "any" name="price">
                        </label>
                    </p>
                    <p>
                        <label>
                            Quantité desirée:
                            <input id="inputText" type="number" name="qtt" value="1">
                        </label>
                    </p>
                    
                    <!-- Bouton pour ajouter le produit -->
                    <button type="submit" id="btnAdd"  name="submit" >Ajouter le produit</button>
                    
                    <!-- Notification du nombre de produits ajoutés -->
                    <p id="nombreProducts">Nombre de produits ajouté: <?=$nb_products?></p>

                    <!-- Bouton pour changer la page -->
                    <button formaction='traitement.php?action=recap' method="post" id="btnRecap">Consulter le panier</button>

                    <!-- Bouton pour supprimer le panier -->
                    <button formaction='traitement.php?action=removeAllIndex' id="btnRemoveAllIndex">Supprimer tous les produits</button>
                </form>
            </div>
        </div>
    

    

    <?php



    //stocke les données de l'output in une variable
    $content = ob_get_clean();

    //titre de la page
    $titre = "Index";

    //demande de le template
    require "template.php";