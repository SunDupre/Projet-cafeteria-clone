<?php

require_once 'connection.php';
//require ("enregistrer.php");

$appli = new Connection();

//echo var_dump($user);
/*si j'appuie sur le boutton valider je verifie que l'email 
et password sont bien dans la basse des donnés*/
if (isset($_POST['valider'])) {

    $email = $_POST['email'];
    $password = $_POST['pwd'];  //Il y avait erreur dans le nom du champ retenant le password
 

    $user = $appli->getUserbyEmail($email);

    

    // Vérifiez que le mot de passe (user->getPassword()) du user n’est pas null. 
    // Si c’est le cas, renvoyer (header…) sur la page login.
    if($user == null){
        $error = "L'email utilisé n'a pas été trouvé.";
        // $_SESSION['error'] = $error; Cette instruction ne peut être récupérée dans le formulaire
        
        header("location: ../login.php?error=" .$error);
        exit;
    }

    $passwordHash = $user->getPassword();

     
    if($passwordHash == null){
        $error = "Problème recontré lors de la recherche du mot de passe.";
        // $_SESSION['error'] = $error; Cette instruction ne peut être récupérée dans le formulaire

        header("location: ../login.php?error=" .$error);
        exit;
    }


    // Authentifiez l’utilisateur grâce au mot de passe entré dans le formulaire, 
    // en le comparant au mot de passe de l’objet User, à l’aide de la fonction password_verify.
    $authenticate = password_verify($password, $passwordHash);

    

    // SI le mot de passe n'a pas été vérifié alors erreur
    if(!$authenticate){
        $error = "Le mot de passe n'est pas valide";
        // $_SESSION['error'] = $error; Cette instruction ne peut être récupérée dans le formulaire

        header("location: ../login.php?error=" .$error);
        exit;
    }

    else { 
        // Si la fonction password_verify retourne true, stockez l’id du user dans la session ($_SESSION) 
        // et redirigez vers la page perso.php sinon renvoyez si la page login.php

        session_start();        

        $_SESSION['userId'] = $user->getId();
        $_SESSION['userEmail'] = $user->getEmail();
        $_SESSION['isAdmin'] = $user->getisAdmin();
        header('location: ../bookingUser.php');

        exit;

    }

}



?>