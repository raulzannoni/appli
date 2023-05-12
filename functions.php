<?php

//ce pour calculer tous les elements ajoutés au panier
function totalElements()
    {
        $elements = 0;
        if(!empty($_SESSION['products']))
            {
                foreach($_SESSION['products'] as $index => $product)
                    {
                        $elements += $product['qtt'];
                    }
            }
        return $elements;
    }

//ce detruit la variable SESSION et les fileS
function removeAll()
    {
        $images = glob('upload/*');
        foreach($images as $image) 
            {
                unlink($image);
            }
        $_SESSION['message'] = "<p class='removeAll fadeOut'>Tous les produits sont supprimés</p>";
        unset($_SESSION['products']);
    }

//ce detruit un produit de la variable Session
function removeProduct($id)
    {
     
        //pour conserver l'index, on utilise array_splice plutot que unset
        $_SESSION['message'] = "<p class='removeProduct fadeOut'>Product ".$_SESSION['products'][$id]['name']." supprimé dans le panier</p>";
        array_splice($_SESSION['products'], $id, 1);
    }

//ce ajoute un produit
function addQuantity($id)
    {
        $_SESSION['message'] = "<p class='addQuantity fadeOut'>Quantité de product ".$_SESSION['products'][$id]['name']." augmenté de 1</p>";
        $_SESSION["products"][$id]["qtt"]++;
        newTotal($id);
    }

//ce diminue un produit
    function deleteQuantity($id)
    {   
        if($_SESSION["products"][$id]["qtt"] > 1)
            {
                $_SESSION['message'] = "<p class='deleteQuantity fadeOut'>Quantité de product ".$_SESSION['products'][$id]['name']." réduit de 1</p>";
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

//s'il y a un message => affichement et effacement de la SESSION message
function getMessages() 
    {
        if(isset($_SESSION['message']) && !empty($_SESSION['message'])) 
            {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
    }
    

?>