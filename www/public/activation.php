<?php
require_once 'connection.php';

// page intermédiaire (elle ne se verra pas sur le site)
//variable qui recupere l'id de l'utilisateur et sa cle unique
$id = $_GET['id'];
$validationKey = $_GET['key'];

//Recuperation de l'utilisateur par son id
$appli = new Connection;
$user = $appli->getUserById($id);

//si la cle n'est pas la meme rediriger a la page inscription.php
if ($validationKey != $user->getvalidationKey()) {
    header('Location:inscription.php');
    exit();
}

//appel de la function activuser dans connection.php dans le cas ou sa a marché
$appli->activateUser($id);

//rediriger vers la page login.php
header('Location:login.php');
