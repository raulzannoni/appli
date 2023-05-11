<?php

//ce detruit la variable Session
function removeAll()
    {
        $_SESSION['message'] = "<p class='removeAll'>Tous les produits sont supprimés</p>";
        unset($_SESSION['products']);
    }

//ce detruit un produit de la variable Session
function removeProduct($id)
    {
        //unset($_SESSION["products"][$id]);
        
        //pour conserver l'index
        $_SESSION['message'] = "<p class='removeProduct'>Product ".$_SESSION['products'][$id]['name']." supprimé dans le panier</p>";
        array_splice($_SESSION['products'], $id, 1);
    }

//ce ajoute un produit
function addQuantity($id)
    {
        $_SESSION['message'] = "<p class='addQuantity'>Quantité de product ".$_SESSION['products'][$id]['name']." augmenté de 1</p>";
        $_SESSION["products"][$id]["qtt"]++;
        newTotal($id);
    }

//ce diminue un produit
    function deleteQuantity($id)
    {   
        if($_SESSION["products"][$id]["qtt"] > 1)
            {
                $_SESSION['message'] = "<p class='deleteQuantity'>Quantité de product ".$_SESSION['products'][$id]['name']." réduit de 1</p>";
                $_SESSION["products"][$id]["qtt"]--;
                newTotal($id);
            }
        else
            {
                removeProduct($id);
            }
    }

//ce rafraichit le prix général après chaque modification
function newTotal($id)
    {
        $_SESSION["products"][$id]["total"] = $_SESSION["products"][$id]["price"]*$_SESSION["products"][$id]["qtt"];
    }

?>