<!-- template pour chaque page affiché, il faut utiliser ob_start-->
<!-- $titre = titre de la page ajouté aprés l'initialisation de la variable ob_get_clean-->
<!-- $content = initialisation de la variable ob_get_clean, que est le codage à gerer de la page-->

<!-- Similair à require, mais si le code php est déjà ajouté, le codage n'est pas inclus encore-->
<?php require_once 'functions.php' ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title> <?= $titre ?></title>
</head>
<body>

    <!-- Fonction pour afficher les actions de l'utilisateur-->
    <?php getMessages(); ?>
    
    <!-- Contenu de la page qui vient demarré par le codage pour lequelle ce template est inclus-->
    <?= $content; ?>
    
    <!-- Script pour gerer le modal-->
    <script src='modal.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
</body>
</html>