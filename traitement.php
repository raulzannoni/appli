<?php

//deux differents utilités
//1) demarrer une session sur le serveur pour l'utilisateur courant
//2) recuperer la session de ce meme utilisateur s'il en avait dejà une
session_start();
require "functions.php";


$id = (isset($_GET['id'])) ? $_GET['id'] : null;

if(isset($_GET['action']))
    {
        switch($_GET['action'])
            {
                case 'addProduct':
                    //pour limiter l'acces à traitement.php 
                    //par les seules requetes HTTP provenant de la soumission de notre formulaire
                    //on va à verifier de la clé "submit" dans le tablea $_POST
                    //la condition sera alors vraie seulement 
                    //si la requete POST transmet bien une clé "submit" au serveur
                    if(isset($_POST['submit']))
                    {
                        //nous devons verifier l'integrité des valeurs transimes dans la tableau $_POST
                        //en fonction de celles que nous attendons réellement
                        
                        //filter_input(): renvoie de cas de succes la valeur assainie correspondant au champ traité
                        //sinon false si le filtre échoue ou null si le champ sollicité par le nettoyage n'existait pas dans la requete POST
                        //PAS DE RISQUE QUE L'UTILISATEUR TRANSMETTRE DES CHAMPS SUPPLEMENTAIRES!

                        //FILTER_SANITIZE_SPECIAL_CHARS: supprime une chaine de caracteres de toute presence de caracteres speciaux et de toute balise HTML potentielle ou les encode
                        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        //FILTER_VALIDATE_FLOAT: validera le prix s'il est un nombre à virgule
                        //la flag FILTER_FLAG_ALLOW_FRACTION pour permettre l'utilisation de caractere "," ou "." pour la decimale
                        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        
                        //FILTER_VALIDATE_INT: validera la quantité que si celle-ci est un nombre entier different de zero
                        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                        //Il nous faut verifier si les filtres ont tous fonctinné grace à une nouvelle condition:
                        //il suffit de verifier implicitement si chaque variable contient une valeur jugée positive par PHP
                        if($name && $price > 0 && $qtt > 0)
                            {
                                //il nous faut stocker nos données en session, en ajoutant celles-ci au tableau $_SESSION que PHP nous fournit
                                $product = [
                                    "name"  => $name,
                                    "price" => $price,
                                    "qtt"   => $qtt,
                                    "total" => $price*$qtt
                                ];

                                //il faut enregistrer ce produit nouvellement créé par en session
                                //1) on sollicite le tableau de session $_SESSION fourni par PHP
                                //2) on indique la clé "products" de ce tableau. Si la clé n'existe pas, PHP la créera au sein de $_SESSION
                                //3) les [] sont raccourci pour indiquer à cet emplacement que nous ajoutons une nouvelle entrée au futur tableau "products" associé a cette clé
                                //$_SESSION['products'] doit etre aussi un tableau afin d'y stocker de nouveaus produits par la suite
                                $_SESSION['products'][] = $product;
                                $_SESSION['message'] = "<p class='success'>Produit $name ajouté au panier</p>";
                            }
                        elseif($name && ($price <= 0 || $qtt <= 0))
                            {
                                $_SESSION['message'] = "<p class='insuccess'>Produit $name impossible à ajoutér au panier! Prix ou quantité negatif ou nul!</p>";
                            }
                        elseif(!$name)
                            {
                                $_SESSION['message'] = "<p class='insuccess'>Ajouter un nom au produit!</p>";
                            }
                        
                       

                    }
                
                // Apres l'ajoute de le produit, la page index est demarré
                header("Location:index.php");
                break;

                // Redirect page index
                case "index":
                    header("Location:index.php");
                    break;
                    
                // Redirect page recap
                case "recap":
                    header("Location:recap.php");
                    break;

                // Vider le panier
                case "removeAll":
                    removeAll();
                    header("Location:recap.php");
                    break;

                // Vider le panier dans l'index
                case "removeAllIndex":
                    removeAll();
                    header("Location:index.php");
                    break;

                // Supprimer un produit
                case "removeProduct":
                    removeProduct($id);
                    header("Location:recap.php");
                    break; 

                // Ajouter un produit
                case "addQuantity":
                    addQuantity($id);
                    header("Location:recap.php");
                    break; 

                // Diminuer un produit
                case "deleteQuantity":
                    deleteQuantity($id);
                    header("Location:recap.php");
                    break; 


            }
    }




//si la requete POST è trasmet par la clé "submit"
//ceça effectuera une redirection grace à la fonction header()
//deux precautions:
//1) la page qui l'emploie ne doit pas avoir émis un debut de reponse avant header()
//2) l'appel de la fonction header() n'arrete pas l'execution du script courant

?>