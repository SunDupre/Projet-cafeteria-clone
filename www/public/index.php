<?php
session_start();

require 'weekUtils.php';
require 'connection.php';

$appli = new connection;
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php' ?>

    <title>Menu Cafétéria Réalise</title>
</head>

<body>
<?php

// On rempli nos variables
// Est ce que le user est connecté ou pas
if (!isset($_SESSION["userId"])) {
    $userConnect = false;
} else {
    $userConnect = true;
    // Est ce que le user est admin?
    $user = $appli->getUserById($_SESSION["userId"]);
    $isAdmin = $user->getisAdmin();
}


/* NAVABAR
<!--si c'est l'admin ajouter la nav var admin et sinon la va var user */
// Le user n'est pas connecté => cas 1
if (!$userConnect) {
    include 'nav-publique.inc.php';
} else {
    // Le user est connecté => cas 2 et 3
    // Le user n'est pas admin => cas 2
    if (!$isAdmin) {
        // Afficher navbar 2
        include 'nav-user.inc.php';
    } else {
        // Le user est admin => cas 3
        // Afficher navbar 3
        include 'nav-admin.inc.php';
    }
}
?>

<h1>Menu de la Semaine</h1>
<!-- requperer le semain courant -->
<?php
$weekParam = 0;
$thisWeek = date("W") + $weekParam;
$weekTab1 = weekToTab1($thisWeek);
$jour = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
$i = 0; ?>

<!-- button ce semain -->
<div id="boutton" class="d-flex justify-content-around">
    <button type="button" class="btn btn-outline-info" id="dateShow">
        <?php $firstday = date('W:  d/m', strtotime("monday 0 week"));
        echo "Semaine ", $thisWeek, "\n"; ?>
    </button>
</div>


<div class="container">
    <div class=" card text-center">
        du<?php echo "' '" . $weekTab1[0] . "' '" ?> au <?php echo $weekTab1[1]; ?>
    </div>
</div>

<!-- MENU PAR OBJET AVEC POSSIBILITÉ D'INTEGRATION IMG-->

<?php
$weekTab = weekToTab($thisWeek);

foreach ($weekTab as $date) {

    //Récupérer les plat du jour chaque jour
    $mainDish = $appli->getTypeDishByDate(8, $date);

    if (!$mainDish) {
        $mainDishName = "";
        $mainDishDescription = "";
        $mainDishPrice = "";
        $reserve = "";
    } else {
        $mainDishName = $mainDish->getName($date);
        $mainDishDescription = $mainDish->getDescription();
        $mainDishPrice = $mainDish->getPrice();
        $reserve = "Resrvation";
    }

    ?>


<div class="text-center container">

        <?php echo $jour[$i];
        $i++; ?>

    <!--Label bleu Début-->

        <div class="row">
            <label class="col-3 bg-info rounded border" for="Select1">Catégorie du plat</label>
            <label class="col-3 bg-info rounded border" for="Select1">Nom</label>
            <label class="col-4 bg-info rounded border" for="Select1">Description</label>
            <label class="col-2 bg-info rounded border" for="Select1">Prix</label>
        </div>
    <!--Label bleu Fin-->


    <!--Plat du jour $ Début-->
            <div class="row">
                <label class="col-3 bg-light rounded border" for="Select1"><strong>Plat du jour</strong></label>
                <label class="col-3 bg-light rounded border" for="Select1"><?php echo $mainDishName; ?></label>
                <label class="col-4 bg-light rounded border" for="Select1"><?php echo $mainDishDescription; ?></label>
                <label class="col-2 bg-light rounded border" for="Select1"><?php echo $mainDishPrice; ?></label>
            </div>
    <!--Plat du jour $ Fin-->


    <?php
    //Récupérer les desert chaque jour
    $desert = $appli->getTypeDishByDate(7, $date);

    if (!$desert) {
        $desertName = "";
        $desertDescription = "";
        $desertPrice = "";
    } else {
        $desertName = $desert->getName();
        $desertDescription = $desert->getDescription();
        $desertPrice = $desert->getPrice();
    }

    ?>
    <!--Dessert $ Début-->

            <div class="row">
                <label class="col-3 bg-light rounded border" for="Select1"><strong>Dessert</strong></label>
                <label class="col-3 bg-light rounded border" for="Select1"><?php echo $desertName; ?></label>
                <label class="col-4 bg-light rounded border" for="Select1"><?php echo $desertDescription; ?></label>
                <label class="col-2 bg-light rounded border" for="Select1"><?php echo $desertPrice; ?></label>
            </div>
    <!--Dessert $ Fin-->


    <?php
    //Récupérer les entrées chaque jour
    $entre = $appli->getTypeDishByDate(1, $date);

    if (!$entre) {
        $entreName = "";
        $entreDescription = "";
        $entrePrice = "";
    } else {
        $entreName = $entre->getName();
        $entreDescription = $entre->getDescription();
        $entretPrice = $entre->getPrice();
    }

    ?>

    <!--Entrée $ Début-->

            <div class="row">
                <label class="col-3 bg-light rounded border" for="Select1"><strong>Entrée</strong></label>
                <label class="col-3 bg-light rounded border" for="Select1"><?php echo $entreName; ?></label>
                <label class="col-4 bg-light rounded border" for="Select1"><?php echo $entreDescription; ?></label>
                <label class="col-2 bg-light rounded border" for="Select1"><?php echo $entrePrice; ?></label>
            </div>
    <!--Entrée $ Fin-->
</div>

    <?php } ?>
    <!-- PLAT VEGGIE (1 ENTRÉE)-->
    <!-- MENU PAR OBJET AVEC POSSIBILITÉ D'INTEGRATION IMG-->

    <?php
        $veggiDish = $appli->getVeggiDishByDate($date);

        if (!$veggiDish) {
            $veggiDishName = "";
            $veggiDishDescription = "";
            $veggiDishPrice = "";
            $reserve = "il n'y a pas de plat veggi cet semain";
        } else {
            $veggiDishName = $veggiDish->getName();
            $veggiDishDescription = $veggiDish->getDescription();
            $veggiDishPrice = $veggiDish->getPrice();
        } 
    ?>

    <h4 class="text-center">Le plat végétarien
        <?php echo "/ Semaine ", $thisWeek, "\n"; ?>
    </h4>

<div class="text-center container">

    <!--Label bleu Début-->
            <div class="row">
                <label class="col-4 bg-info rounded border" for="CatPlat">Catégorie du plat</label>
                <label class="col-3 bg-info rounded border" for="Select1">Nom</label>
                <label class="col-3 bg-info rounded border" for="Select1">Description</label>
                <label class="col-2 bg-info rounded border" for="Select1">Prix</label>
            </div>
    <!--Label bleu Fin-->
    

    <!--Plat végétarien $ Début-->
            <div class="row">
                <label class="col-4 bg-light rounded border" for="Select1"><strong>Plat végétarien</strong></label>
                <label class="col-3 bg-light rounded border" for="Select1"><?php echo $veggiDishName; ?></label>
                <label class="col-3 bg-light rounded border" for="Select1"><?php echo $veggiDishDescription; ?></label>
                <label class="col-2 bg-light rounded border" for="Select1"><?php echo $veggiDishPrice; ?></label>
            </div>
    <!--Plat végétarien $ Fin-->
</div>

<?php require_once 'footer.inc.php' ?>
</body>
</html>
