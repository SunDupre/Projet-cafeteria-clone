<?php
session_start();

if (isset($_SESSION['userId'])) {
    //déjà loger alors redirection page profil
    header("Location:bookingUser.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php'; ?>

    <title>Menu Cafétéria Realise - Login</title>
</head>

<body>
<?php require_once 'nav-user.inc.php'; ?>

<div id="page-container">
    <form method="POST" name="proces_login" action="process/login.php">
        <div id="content-wrap" class="container-fluid mt-5">
            <div id="formulaire" class="row">
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <Label>Compte:</label>
                        <input id="pseudo" class="barre pseudo form-control" type="text" name="email"
                               placeholder="Votre Email" required>
                    </div>
                    <div class="form-group">
                        <Label>Mot de passe:</label>
                        <input id="mdp" class="barre form-control" type="password" name="pwd"
                               placeholder="Votre Password" required>
                    </div>
                   
                    <?php
                    // This section is aiming to display an error message
                        if(isset($_GET['error'])){
                            $error = $_GET['error'];
                            echo '<div class="alert alert-danger">' .$error .'</div>';            
                        }

                    ?>  

                    <div class="form-group float-right">
                        <input id="login" class="bg-info input-group-text text-white" type="submit" name="valider"
                               value="Connexion">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once 'footer.inc.php' ?>
</body>
</html>



