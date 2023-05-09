<?php
function removeAll()
    {
        unset($_SESSION['products']);
    }

function removeProduct($id)
    {
        unset($_SESSION["products"][$id]);
    }

function addQuantity($id)
    {
        $_SESSION["products"][$id]["qtt"]++;
        newTotal($id);
    }

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

function newTotal($id)
    {
        $_SESSION["products"][$id]["total"] = $_SESSION["products"][$id]["price"]*$_SESSION["products"][$id]["qtt"];
    }

?>