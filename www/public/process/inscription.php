<?php
require_once 'connection.php';
require 'config.php';
// page intermédiaire (elle ne se verra pas sur le site)

//1 variables 
$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['pwd'];
$password2 = $_POST['pwd2'];

if (empty($firstname)) {
    $error = 'le champ de prenom est vide';
    header("location: ../inscription.php?error=" .$error);
    exit;

}
if (empty($lastname)) {
    $error = 'le champ de nom est vide';
    header("location: ../inscription.php?error=" .$error);
    exit;
}
if (empty($email)) {
    $error = 'le champ de email est vide';
    header("location: ../inscription.php?error=" .$error);
    exit;
}
if (empty($password)) {
    $error = 'le champ de mot de pass est vide';
    header("location: ../inscription.php?error=" .$error);
    exit;
}
if (empty($password2)) {
    $error = 'le champ de confirm mot de pass est vide';
    header("location: ../inscription.php?error=" .$error);
    exit;
}

if ($password !== $password2) {
    $error = 'Attention , les deux champs de mots de pass sont identiques';
    header("location: ../inscription.php?error=" .$error);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "L'email est incorrect";
    header("location: ../inscription.php?error=" .$error);
    exit;
}


/*if (!empty($error)) {
    echo '<div class="errors"><ol>';
    foreach ($error as $value) {
        echo '<li>' . $value . '</li>';
    }
    echo '</ol></div>';
}*/

//2 J'appelle la fonction vérifier email
$appli = new Connection();
$emailOk = $appli->verifierEmailRealise($email);

//2b Si l'email n'est pas bon alors rediriger vers inscription
if (!$emailOk) {
    $error = "L'email n'est pas correct";
    header('Location: ../inscription.php?error='.$error);
    exit();
}
//3 
//3a hachage du mot de passe             
$hash_pass = password_hash($password, PASSWORD_DEFAULT);

//3b function qui Génére la clé unique pour le utilisateur
$key = uniqid();
$activeUser = 1;

$testSeulEmail = $appli->verifierSeulEmail($email);


if($testSeulEmail == 0){
//3c insérer un utilisateur et recuperer son id
$id = $appli->insertUser($email, $hash_pass, 0, $activeUser, $key, $lastname, $firstname);
}else{
    $error = "L'email est deja utliser";
    header('Location: ../inscription.php?error='.$error);
    exit();
}
//4 générer l'email

$to = $email;
$subject = 'Activation de votre compte Réalise';
$message = "<div>Bonjour,</div>
<div>&nbsp;</div>
<div>Vous avez cr&eacute;&eacute; un compte sur l'application <strong>R&eacute;alise Caf&eacute;t&eacute;ria</strong>.</div>
<div>&nbsp;</div>
<div>Pour activer votre compte, veuillez cliquer sur le lien suivant :</div>
<div>&nbsp;</div>
<div><a href=\"".BASE_URL."/activation.php?id=$id&key=$key\" target=\"_blank\">Lien d'activation</a></div>";
$headers = 'From: donotreply@realisecafetariat.ch' . "\r\n" .
    'Reply-To: donotreply@realisecafetariat.ch' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//5 Envoyer l'email
mail($to, $subject, $message, $headers);

//6 Rediriger vers la page demande_activation.php
header('Location:../bookingUser.php');