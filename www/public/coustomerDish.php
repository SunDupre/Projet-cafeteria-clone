<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php' ?>

    <title>Menu RR</title>
</head>
<body>

<!-- NAVABAR -->
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#">RRéalise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
<!-- La fin de Navbar -->

<!-- le debut de Main page -->
<div class="container">
    <h2 class="text-center mt-3">Plat Du Client</h2><br>
    <div class="d-flex justify-content-around m-5">
        <button type="button" class="btn btn-outline-primary">preccedent</button>
        <button type="button" class="btn btn-outline-info">Semain 4 - 8 mars</button>
        <button type="button" class="btn btn-outline-success ">Suivant</button>
    </div>
    <div class="container">
        <div class="row mb-3">
            <div class="col bg-success">Plat du jour</div>
            <div class="col bg-warning">Plat du veg</div>
            <div class="col bg-success">Rien</div>
            <div class="col bg-warning">Nom</div>
        </div>
        <form>
            <div class="row">
                <div class="col">
                    <input type="radio" name="optradio">
                </div>
                <div class="col">
                    <input type="radio" name="optradio">
                </div>
                <div class="col">
                    <input type="radio" name="optradio">
                </div>
                <span>Rahmat</span>
                <div class="">
                    <input class="btn btn-success" type="submit" value="Valider">
                </div>
            </div>
        </form>

    </div>
</div>
<!-- La fin de Main Page -->

<?php require_once 'footer.inc.php' ?>
</body>
</html>