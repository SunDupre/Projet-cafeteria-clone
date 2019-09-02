<?php

session_start();
require_once 'connection.php';
$appli = new Connection();

// Si le bouton validé est cliqué depuis la page preview
if (isset($_POST["valider"])) {

    $appli->validDishes();

    //header("Location:index.php");

}

// Si le bouton ajouté est cliqué depuis la page addDish
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = floatval($_POST["price"]);
    $startDate = date('Y-m-d');
    $endDate = date('Y-m-d');
    $typeOfDish = $_POST["typeOfDish"];

    /* $appli->getDishByWeek($name, $description, $price , $startDate, $endDate, $preview,$typeOfDish); */
    $newDish = $appli->insertDishWeek($name, $description, $price, $startDate, $endDate, 1, $typeOfDish);
}








