<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

require_once 'connection.php';
require_once 'weekUtils.php';

if (!isset($_GET['week'])) {
    $weekParam = 0;
} else {
    $weekParam = $_GET['week'];
}

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php' ?>

    <title>Booking User</title>
</head>

<body>
<?php

$appli = new Connection();
$user = $appli->getUserById($_SESSION["userId"]);
$isAdmin = $user->getisAdmin();

/* NAVABAR
<!--si c'est l'admin ajouter la nav var admin et sinon la va var user */
if ($isAdmin) {
    include 'nav-admin.inc.php';
} else {
    include 'nav-user.inc.php';
}

?>
<div class="container">
    <h2 class="text-center"> Réservations </h2><br>
    <div id="boutton" class="d-flex justify-content-around">
        <button type="button" class="btn btn-outline-info" id="dateShow">

            <?php
            //fonction pour afficher la plage des dates de lundi et les vendredie courante et le format convertir lang francais

            $i = 0;
            $thisWeek = date("W") + $weekParam;
            $weekTab1 = weekToTab1($thisWeek);

            //$firstday = date('W:  d/m', strtotime("monday 0 week"));
            echo "Semaine ", $thisWeek, "\n"; ?>   </button>
    </div>
    <div class="text-center">
        <p class="text-align-center"> du <?php echo $weekTab1[0] . "  "; ?><br>
            au <?php echo $weekTab1[1]; ?></p>
    </div>
</div>

<div class="container">
    <table class="table">
        <thead class="thead-info">
        <tr>
            <th scope="col-sm-3">Jour</th>
            <th scope="col-sm-2">Plat du jour</th>
            <th scope="col-sm-2">Plat végétarien</th>
            <th scope="col-sm-2">Aucun plat</th>
            <th scope="col-sm-2"></th>
        </tr>
        </thead>

        <tbody>
        
        
        <?php
        // definir variables php
        $idUser = $_SESSION["userId"];
        
       
        $weekTab = weekToTab($thisWeek);

        ?>

        <div class="input-group">
            <?php
            $jour = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
            ?>

            <?php

            foreach ($weekTab as $date) {
            //
                $booking = $appli->getUserBooking($idUser, $date);
                                
                if (!$booking) {
                    $typeOfDish = false;

                } else {
                    $typeOfDish = $booking->getTypeOfDish();
                }

                $mainDish = $appli->getMainDishByDate($date);

                if (!$mainDish) {
                    $mainDishName = "";
                } else {
                    $mainDishName = $mainDish->getName();
                }
                
               // echo "main dish : ".$mainDishName." à la date ".$date."<br/>";
                
                $veggiDish = $appli->getVeggiDishByDate($date);
    
                if (!$veggiDish) {
                    $veggiDishName = "";
                } else {
                    $veggiDishName = $veggiDish->getName();
                }
                //echo "veggi dish : ".$veggiDishName." à la date ".$date."<br/>";
             
            


                ?>
                <form action="process/validation.php" method="post">


                    <input type="hidden" name="dateReservation" value="<?php echo $date; ?>">

                    <tr>
                        <td>

                            <?php
                            echo $jour[$i];
                            $i++;
                            ?>
                            <label type="label" name="jour">

                        </td>
                        <td>
                        <label>
                            <input type="radio" name="typeOfDish"
                                <?php if ($typeOfDish == 8) echo "checked"; ?>
                                value="8"><?php echo $mainDishName; ?>
                                </label>

                        </td>
                        <td>
                        <label>
                            <input type="radio" name="typeOfDish"
                                <?php if ($typeOfDish == 9) echo "checked"; ?>
                                value="9"> <?php echo $veggiDishName; ?>
                                </label>
                        </td>
                        <td>
                        <label>
                            <input type="radio" name="typeOfDish"
                                <?php if (!$typeOfDish) echo "checked"; ?>
                                value="0">rien
                                </label>

                        </td>

                        <td>
                            <button type="submit" name="submit" id="validation" class="btn btn-outline-success"
                                    value="Submit">Valider
                            </button>
                        </td>

                    </tr>


                </form>
            <?php 
           } ?>
    </table>
</div>
<div class="container">
    <div class="row mt-5 ml-1">
        <?php
        if ($weekParam == 0) {
            // On est dans la semaine courante ; on veut afficher le bouton semaine prochaine
            echo '<a class="btn btn-primary" href= "bookingUser.php?week=1">Semaine prochaine</a>';
        } else {
            // On est la semaine prochaine ; on veut afficher le bouton semaine courante
            echo '<a class="btn btn-primary" href= "bookingUser.php?week=0">Semaine courante</a>';
        }
        ?>
    </div>
</div>
<?php require_once 'footer.inc.php' ?>
</body>
</html>
