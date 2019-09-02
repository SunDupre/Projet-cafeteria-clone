<?php
require_once 'connection.php';
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once 'externals.inc.php' ?>

    <title>List Orders</title>
</head>
<body>
<?php
$id = $_SESSION["userId"];
$appli = new Connection();
$user = $appli->getUserById($id);
$isAdmin = $user->getisAdmin();

include "nav-admin.inc.php";
?>
<div class="container">
    <h2 class="text-center"> Liste des Réservations </h2><br>
    <?php
    if (isset($_POST["dateReservation"])) {
        $date = $_POST["dateReservation"];
        echo "une date a ete choisie : " . $date;
    } elseif (isset($_GET["dateReservation"])) {
        $date = $_GET["dateReservation"];
        echo "une date a ete choisie : " . $date;
    } else {
        $date = date("Y-m-d");
        echo "aucune date n'a ete choisie : " . $date;
    }
    ?>

    <form action="" method="GET" id="dateForm">
        <input type="date" name="dateReservation" value=<?php echo '"' . $date . '"' ?>>
        <input type="submit" value="Choisir cette date">
    </form>
</div>
<?php
$countVeggiDish = $appli->getNumberDish($date, 9);
$countMainDish = $appli->getNumberDish($date, 8);
?>

<div class="container">
    <table class="table">
        <thead class="thead-info">
        <tr>
            <th scope="col-sm-3">nom</th>
            <th scope="col-sm-2">Plat du jour <?php echo "(" . $countMainDish . ")" ?></th>
            <th scope="col-sm-2">Plat végétarien <?php echo "(" . $countVeggiDish . ")" ?> </th>
            <th scope="col-sm-2">Aucun plat</th>
            <th scope="col-sm-2"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        // definir variables php
        $idUser = $_SESSION["userId"];

        $users = $appli->getAllUsers();
        /*
        if (!$booking) {
            $typeOfDish = false;
        } else {
            $typeOfDish = $booking->getTypeOfDish();
        }

        $mainDish = $appli->getMainDishByDate("2019-03-20");
        $veggiDish = $appli->getVeggiDishByDate("2019-03-20");
        */
        ?>
        <?php
        $i = 0;
        foreach ($users as $user) {

            $booking = $appli->getUserBooking($user, $date);
            if (!$booking) {
                $typeOfDish = false;
            } else {
                $typeOfDish = $booking->getTypeOfDish();
            }

            ?>
            <form action="process/listOrders.php" method="post">
                <input type="hidden" name="user" value=<?php echo '"' . $user->getId() . '"' ?>/>
                <input type="hidden" name="dateReservation" value=<?php echo '"' . $date . '"' ?>/>
                <tr>
                    <td>
                        <label type="label"
                            name="userName"><?php echo $user->getLastName() . ' ' . $user->getFirstName() ?></label>
                    </td>
                    <td>
                        <input type="radio" name="typeOfDish" <?php if ($typeOfDish == 8) echo "checked"; ?> value="8">
                    </td>
                    <td>
                        <input type="radio" name="typeOfDish" <?php if ($typeOfDish == 9) echo "checked"; ?> value="9">
                    </td>
                    <td>
                        <input type="radio" name="typeOfDish" <?php if (!$typeOfDish) echo "checked"; ?> value="0">

                    </td>
                    <td>
                        <button type="submit" id="validation" class="btn btn-outline-success" value="<?php echo $i; ?>">
                            Valider
                        </button>
                    </td>

                </tr>
            </form>
            <?php
            $i++;
        } ?>


    </table>
</div>
<?php require_once 'footer.inc.php' ?>
</body>
</html>