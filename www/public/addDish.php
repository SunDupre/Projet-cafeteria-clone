<?php

require_once 'connection.php';

session_start();


if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$appli = new Connection;
$weekParam = (isset($_GET['week'])) ? $_GET["week"] : 0;
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php' ?>

    <title>Ajout Plat RR</title>
</head>


<body>

<!-- NAVABAR -->
<?php

include '../includes/nav-admin.inc.php';
?>
<div class="content container">
    <!-- <form action="process_preview.php" method="POST"> -->
    <!-- COLLAPSE BURGER -->
    <div class="collapse navbar-collapse" id="navbarSupported Content content-inside">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="login.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.html">Reservation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.html">Conditions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.html">Login</a>
            </li>
        </ul>
    </div>
    </nav>

    <h2 class="text-center"> Édition Plat</h2><br>
    <div class="d-flex justify-content-around">
        <button type="button" class="btn btn-outline-info" id="dateShow">
            <?php
            $week = date("W") + $weekParam;
            //$firstday = date('W:  d/m', strtotime("monday 0 week"));
            echo "Semaine ", $week, "\n";
            ?>
        </button>
    </div>
    <br>

    <h2 class="text-center"> Plat Hebdomadaire </h2>
    <form action="" method="POST">
        <input type="hidden" name="dateReservation" value="<?php echo $date; ?>">

        <div class="container">
            <div class="input-group">
                <div class="form-control bg-info">Catégorie du plat</div>
                <div class="form-control bg-info">Nom</div>
                <div class="form-control bg-info">Description</div>
                <div class="form-control bg-info">Prix</div>
            </div>

            <div class="input-group">
                <div name="typeOfDish" value="2" class="form-control">Salade</div>
                <input name="nom" class="form-control">
                <input name="description" class="form-control">
                <input name="price" class="form-control">
            </div>

            <div class="input-group">
                <div name="typeOfDish" value="4" class="form-control">Sandwich</div>
                <input name="nom" class="form-control">
                <input name="description" class="form-control">
                <input name="price" class="form-control">
            </div>
            <div class="input-group">
                <div name="typeOfDish" value="5" class="form-control">Panini</div>
                <input name="nom" class="form-control">
                <input name="description" class="form-control">
                <input name="price" class="form-control">
            </div>
            <div class="input-group">
                <div name="typeOfDish" value="6" class="form-control">Pâtes</div>
                <input name="nom" class="form-control">
                <input name="description" class="form-control">
                <input name="price" class="form-control">
            </div>


            <div class="input-group">
                <div name="typeOfDish" value="9" class="form-control">Plat végétarien</div>
                <input name="nom" class="form-control">
                <input name="description" class="form-control">
                <input name="price" class="form-control">
            </div>
        </div>
    </form>
    <h2 class="text-center"> Plat du jour </h2>
    <div class="input-group">
        <div class="form-control bg-info">Jour</div>
        <div class="form-control bg-info">Nom de l'Entrée</div>
        <div class="form-control bg-info">Nom du Plat</div>
        <div class="form-control bg-info">Description du Plat</div>
        <div class="form-control bg-info">Nom du Dessert</div>

        <div class="form-control bg-info">Prix</div>

    </div>
    <div class="input-group">
        <div class="form-control">Lundi</div>
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
    </div>
    <div class="input-group">
        <div class="form-control">Mardi</div>
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
    </div>
    <div class="input-group">
        <div class="form-control">Mercredi</div>
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
    </div>
    <div class="input-group">
        <div class="form-control">Juedi</div>
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
    </div>
    <div class="input-group">
        <div class="form-control">Vendredi</div>
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
        <input class="form-control">
    </div>


    <div class="row mt-5 ml-1">
        <button type="submit" name="submit" class="btn btn-info" value="<?php echo $weekParam; ?>">Enregistrer</button>
        <?php
        if ($weekParam == 0) {
            // On est dans la semaine courante ; on veut afficher le bouton semaine prochaine
            echo '<a class="btn btn-primary" href= "addDish.php?week=1">Semaine prochaine</a>';
        } else {
            // On est la semaine prochaine ; on veut afficher le bouton semaine courante
            echo '<a class="btn btn-primary" href= "addDish.php?week=0">Semaine courante</a>';
        }
        ?>
    </div>
</div>

<?php require_once 'footer.inc.php' ?>
</body>
</html>
