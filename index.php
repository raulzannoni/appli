<?php

    //il faut de parcourir le tableau de session, 
    //il est donc necessaire d'appeler la fonction session_start() en debut de fichier afin de recuperer
    //la session correspondante à l'utilisateur
    session_start();

    //demarre l'output avant qu'il est envoyé au serveur
    ob_start();

    //total de le nombre des produits ajoutés
    $nb_products = (!isset($_SESSION['products']) || empty($_SESSION['products'])) ? 0 : count($_SESSION['products']);
    //$totalElements = totalElements(); 
    ?>

    <div id=wrapper>
        <div id=form>
            <h1>Ajouter un produit</h1>
            <!-- 2 attributes: -->
            <!-- action: le fichier à atteindre lorsque l'utilisateur soumettra le formulaire -->
            <!-- method: quelle methode HTTP les données du formulaire seront transmises au serveur -->
            <!-- POST: pour ne pas "polluer" l'URL avec les données du formulaire --> 
            <form method="post" autocomplete="off" enctype="multipart/form-data">
                <p>
                    <label>Nom du produit:</label>
                    <input id="inputText" type="text" name="name">
                </p>
                    <label>Fichier du produit:</label>
                    <div class="file-input">
                        <!--for = id of the input-->
                        <label for="inputFile">Sélectionnez l'image</label>
                        <input class="inputFile" id="inputFile" type="file">
                        <p class="file-name"></p>
                    </div>
                <p>
                    <label> Prix du produit: </label>
                    <input id="inputText" type="number" step= "any" min="0.00" name="price">                   
                </p>
                <p>
                    <label>Quantité desirée:  </label>
                    <input id="inputText" type="number" min="1" name="qtt">
                </p>
                    
                <!-- Bouton pour ajouter le produit -->
                <button formaction="traitement.php?action=addProduct" type="submit" id="btnAdd"  name="submit" >Ajouter le produit</button>
                    
                <!-- Notification du nombre de produits ajoutés -->
                <p id="nombreProducts">Nombre de produits ajouté: <?= $nb_products ?></p>

                <!-- Notification du nombre de produits ajoutés -->
                <p id="totalElements">Nombre des elements ajoutés: <?php //$totalElements ?></p>

                <!-- Bouton pour changer la page -->
                <button formaction='traitement.php?action=recap' id="btnRecap">Consulter le panier</button>

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

?>