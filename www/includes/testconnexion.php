<?php


require 'models/connection.php';
$appli = new Connection;


/* if ($appli->getConnexion() !== null) {
    echo "Connection BD réussie.</br></br>";
}
else {
    echo "Connection BD échoué.</br>";
} 
/* $newReservation=$appli->insertBooking("1", "2019-03-21", "1");
echo $newReservation ;
 */


/*  $newReservation=$appli->insertBooking("1", "2019-03-22", "2");
echo $newReservation ; */
/*$wellDone = $appli->insertUser("benitezjohana92@gmail.com", "12345", "0", "0","12","benitez","johana");
echo $wellDone;*/


//getuserbyid test
/*$result = $appli->getusersById(1);
    var_dump($result);*/

/* $newReservation=$appli->insertBooking("2", "2019-03-21", "1");
echo $newReservation ; 
//Insérer des plats fonction ok.
//getuseremail test

 $x=$appli->insertDish("Salade", "Tomate", "10", "2019-03-20", "2019-03-21", "1", "1");
echo $x; 


$booking =($appli->getDishByDate("2019-03-20"));
var_dump($booking->getTypeOfDish());
*/
/* 
// teste de la fonction recupération de dish par son id ok
 foreach( $bookings as $booking){
    echo "<li>".$booking->getDate()."</li>";
    echo "<li>".$booking->getidUser()."</li>";

/* $dish = $appli->getDishById(1);
        

        var_dump($dish);
        

        $startDate = $appli->getDishByDate(1);
        

        var_dump($startDate);
       

    
}   
$user=$appli->getUserById(1); 
 $booking=$appli->getUserBooking($user, "2019-03-21");
 var_dump($booking);
echo $booking->getDate();



$user = $appli->getUserByEmail("benitezjohana92@gmail.com");
 
echo $user->getEmail();

$user = $appli->updateUser("1","1234","mameche" , "yousra");   
  var_dump($user);

$booking = $appli->updateDish(1,"pats", "tomates", "10,3","2019-03-21","2019-03-22" );
//var_dump($booking);


$testEmail = array("rana@realise.ch",
"toto@realise.ch",
"tutu@realise.com",
"rana@gmail.ch");

foreach($testEmail as $email){
    if($appli->verifierEmailRealise($email)) {
        echo $email." est un email de chez Réalise"."<br/>";
    }else{
        echo $email." n'est pas reconnu"."<br/>";
    }*/
/*
        $list = array('1' => 'Entrée',
                    '2' => 'Salade',
                    '3' => 'Soupe',
                    '4' => 'Sandwich', 
                    '5' => 'Panini', 
                    '6' => 'Pâtes',
                    '7' => 'Dessert',
                    '8' => 'Plat du jour',
                    '9'=> 'Plat végétarien');
    print_r(array_keys($List));
  print_r($list);*/


/* 
    $i=$appli->listOfDish()->$List->key;
 if ($i> 7 ) {
     echo $appli->listOfDish();
     $i++;
} 

var_dump( $appli->getDishByDate("2019-03-21"));*/
$appli->insertBooking(3, "2019-03-25", 9);
?>
