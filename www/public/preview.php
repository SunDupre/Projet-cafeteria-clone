<?php
require_once 'connection.php';
$appli = new Connection;
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php' ?>

    <title>Aperçu RR</title>
</head>
<body>

<!-- NAVABAR -->
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
<!-- La fin de NavBar -->

<!-- Le debut de Main Page -->
<form action="">
    <div class="container mt-5 ">
        <div class="input-group ">
            <div class="form-control bg-info">Catégorie du plat</div>
            <div class="form-control bg-info">Nom</div>
            <div class="form-control bg-info">Description</div>
            <div class="form-control bg-info">Prix</div>
        </div>

        <?php
        $allDish = $appli->getAllDish();

        for ($i = 1; $i <= 9; $i++) {
            if (!empty($allDish[$i])) {
                $name = $allDish[$i][1];
                $description = $allDish[$i][2];
                $id = $allDish[$i][0];
                $prix = $allDish[$i][3];
                echo '
        <div class="input-group">
            <input type="text" class="form-control"value="' . INT_TO_DISH[$i] . '">
            <input type="text" class="form-control" value="' . $name . '">
            <input type="text" class="form-control" value="' . $description . '">
            <input type="text" class="form-control" value="' . $prix . '">
        </div>
        ';
            }
        }
        ?>
    </div>
</form>
<!-- La fin de Main Page -->

<?php require_once 'footer.inc.php' ?>
</body>
</html>