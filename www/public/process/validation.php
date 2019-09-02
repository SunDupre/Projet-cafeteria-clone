<?php
// definer les variables
session_start();

require_once 'connection.php';
$appli = new Connection;
$week = $_GET['week'];
$bookingDate = $_POST['dateReservation'];

if (isset($_POST["submit"])) {
    //$userId=$_POST["submit"];
    $userId = $_SESSION["userId"];
    $dishUser = $_POST["typeOfDish"];
    $appli->insertBooking($userId, $bookingDate, $dishUser);
}
//echo "vous avez reservé".. $days;
header("Location:../bookingUser.php?dateReservation=$bookingDate");

?>