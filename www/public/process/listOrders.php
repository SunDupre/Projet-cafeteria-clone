<?php
require_once 'connection.php';
$appli = new Connection();


//1 variables 
$userId = $_POST['user'];
$bookingDate = $_POST['dateReservation'];
$typeOfDish = $_POST['typeOfDish'];

//Si ça n'existe pas : <-faire une fonction qui cherche si ça existe
// On recupere la reservation

$booking = $appli->getUserBooking($userId, $bookingDate);
if (is_object($booking)) {
    // S'il y a une reservation on la supprime
    $appli->deleteUserBooking($userId, $bookingDate);
}
// Si c'est 8 ou 9 alors inserer une nouvelle reservation
if (($typeOfDish == 8) || ($typeOfDish == 9)) {
    $booking = $appli->insertBooking($userId, $bookingDate, $typeOfDish);
}
header("Location:../listOrders.php?dateReservation=$bookingDate");
//FAIRE UNE FUNCTION DELATE DANS CONNECTION.PHP ET AJOUTER LE RQUETE DE PREPARE CONNECTION
//ET DANS INSERT DICHE RECUPERER LA FUNCTION DANS CONNECTION.PHP

?>
