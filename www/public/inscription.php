<?php
session_start();

if (isset($_SESSION['userId'])) {
    //déjà loger alors redirection page profil
    header("Location:bookingUser.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php' ?>

    <title>inscription</title>
</head>

<body>
<!-- NAVABAR -->
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Menu <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="bookingUser.php">Réservation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Connexion</a>
            </li>
        </ul>
    </div>
</nav>

<!-- formulaire inscription -->
<div class="container">
    <form class="border border-light p-5" method="POST" action="process/inscription.php">

        <p class="h4 mb-4 text-center">Enregistrer</p>

        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prenom">

        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Nom">

        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">

        <input type="password" name="pwd" id="password" class="form-control" placeholder="Mot de passe"
            aria-describedby="defaultRegisterFormPasswordHelpBlock">

        <input type="password" name="pwd2" id="password2" class="form-control"
            placeholder="Confirmation mot de passe" aria-describedby="defaultRegisterFormPasswordHelpBlock">


    <button class="btn btn-info my-4 btn-block" name="creer" id="submit" type="submit">Enregistrer</button>
</form>

<?php
                    // This section is aiming to display an error message
                        if(isset($_GET['error'])){
                            $error = $_GET['error'];
                            echo '<div class="alert alert-danger">' .$error .'</div>';            
                        }

                    ?>  


<?php require_once 'footer.inc.php' ?>
</body>
</html>