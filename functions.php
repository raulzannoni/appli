<?php

//ce detruit la variable Session
function removeAll()
    {
        unset($_SESSION['products']);
    }

//ce detruit un produit de la variable Session
function removeProduct($id)
    {
        //unset($_SESSION["products"][$id]);
        
        //pour conserver l'index
        array_splice($_SESSION['products'], $id, 1);
    }

//ce ajoute un produit
function addQuantity($id)
    {
        $_SESSION["products"][$id]["qtt"]++;
        newTotal($id);
    }

//ce diminue un produit
    function deleteQuantity($id)
    {   
        if($_SESSION["products"][$id]["qtt"] > 1)
            {
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