<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout produit</title>
    </head>
    <body>
        <h1>Ajouter un produit</h1>
        <!-- 2 attributes: -->
        <!-- action: le fichier à atteindre lorsque l'utilisateur soumettra le formulaire -->
        <!-- method: quelle methode HTTP les données du formulaire seront transmises au serveur -->
        <!-- POST: pour ne pas "polluer" l'URL avec les données du formulaire --> 
        <form action="traitement.php" method="post">
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
        </form>
    </body>
</html>