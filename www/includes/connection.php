<?php
require 'models/dish.php';
require 'models/booking.php';
require 'models/user.php';


/*
*Déclaration de la class */

class Connection
{
    private $connection;

    public function __construct()
    {

        require 'config.php';

        // pour tester les bogg
        try {
            $this->connection = new PDO(
                'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER,
                DB_PASSWORD
            );
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br/>';
        }
    }

    /**
     * *récupération de la connection */

    public function getConnection()
    {
        return $this->connection;
    }

    public function resetDatabase()
    {
        $tables = ['booking', 'dish', 'user'];

        foreach ($tables as $table) {
            // NOTE: La partie dynamique de la requête est le nom d’une table.
            // Dans ce cas précis, on ne peut pas utiliser les paramètres de PDO.
            $this->connection->exec("DELETE FROM $table");
        }
    }


    /* -------------***************************----------------
    ----------------******FONCTIONS USER*******----------------
    ----------------***************************---------------*/

    public function getAllUsers()
    {
        $stmt = $this->connection->prepare("SELECT *  FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    /**
     * la function recupere un objet User en fonction de l'id passé en parametre
     */
    public function getUserById($id)
    {
        /*recuperer l'utilisateur apartir de l'id.
        1-Je prepare ma requete
        2-j'execute la requete avec l'id comme parametre
        3-Je recupere l'odjet"user" et il me return* user*/

        $stmt = $this->connection->prepare("SELECT *  FROM user WHERE id = :id");
        $stmt->execute(array('id' => $id,));
        return $stmt->fetchObject('User');
    }

    /**
     * la function recupere un utilisateur($user) en fonction de l'email($email) passé en parametre
     */
    public function getUserbyEmail($email)
    {
        /*recuperer l'user apartir de  son e-mail.
        1-je prepare ma requete
        2-j'execute la requete avec l'email comme parametre
        3-je recupere l'odjet "user" apartir de son email et il me *return email*/

        $stmt = $this->connection->prepare("SELECT *  FROM user WHERE email = :email");
        $stmt->execute(array('email' => $email));
        $user = $stmt->fetchObject("User");
        return $user;
        if (!$user) {

        }
        return false;
        //

    }


    /*
     * la function insere un utilisateur(user) en fonction de tous ces parametres(
     * $email:email de l'utilisateur,
     *  $password: mot de passe de l'utilisateur,
     *  $isAdmin:1 si l'utlisateur est un administrateur 0 si non,
     *  $activeUser: vaux 0 si  l'utlisateur vien d'etre creé car il n'est pas actif et 1 lors qu'il a verifier son email,
     *  $validationKey: cle pour valider l'email,
     *  $lastname: nom de l'utilisateur, 
     * $firstname:prenom de l'utilisateur)
     */
    public function insertUser($email, $password, $isAdmin, $activeUser, $validationKey, $lastname, $firstname)
    {
        /*
        creer un nouveau user
        1-Je prepare ma requete et je lui donne comme parametre toutes les donnés necessaires pour creer  le profil.
        2-execute les parametres dans un tableau
        3-recuperer l'id de la dernier ligne inseré*/

        $stmt = $this->connection->prepare(
            "INSERT INTO user ( email, password, isAdmin, activeUser,validationKey,lastname,firstname) 
        value ( :email, :password, :isAdmin, :activeUser,:validationKey,:lastname,:firstname)"
        );
        $stmt->execute(
            array(

                'email' => $email,
                'password' => $password,
                'isAdmin' => $isAdmin,
                'activeUser' => $activeUser,
                'validationKey' => $validationKey,
                'lastname' => $lastname,
                'firstname' => $firstname,
            )
        );

        $arr = $stmt->errorInfo();
        $id = $this->connection->lastInsertId();
        return $id;
    }

    /*
     * la function verifie que l'email($email)  se termine par @realise.ch
     */
    public function verifierEmailRealise($email)
    {
        // On crée une variable qui contient le pattern
        $pattern = preg_quote("/@realise.ch/");

        // On test si le pattern est trouvé dans l'email et on stocke le resultat
        $result = preg_match($pattern, $email);

        // On retourne le résultat
        return $result;

    }


    /* -------------***************************----------------
    ----------------******add dish******----------------
    ----------------***************************---------------*/


    // Professeur
    /*
     * la function recupere un plat ($dish) en fonction de l'id du plat($id) passé en parametre
     */
    public function validDishes()
    {
        $requete = $this->connection->prepare(
            "update dish set preview = 0 where preview = 1"
        );
        $requete->execute();

    }

    public function getAllDish()
    {
        $requete = $this->connection->prepare(
            "SELECT * FROM dish"
        );
        $requete->execute();
        $dish = $requete->fetchAll(PDO::FETCH_NUM);
        return $dish;
    }

    public function getDishById($id)
    {

        //recuperer le plat apartir de son id.

        //1-preparer ma requete
        $requete = $this->connection->prepare(
            "SELECT * FROM dish WHERE id= :id"
        );

        //2-j'execute la requete avec l'id comme parametre
        $requete->execute(array("id" => $id));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat 

        //$dish = $requete->fetchObject("Dish");
        $dish = $requete->fetch(PDO::FETCH_ASSOC);
        return $dish;
    }

    /*
     * la function recupere un plat($dish)  en fonction de sa date de disponibilité($startDate)
     */
    public function getDishByDate($startDate)
    {

        //recuperer le plat apartir de son id.

        //1-preparer ma requete
        $requete = $this->connection->prepare(
            "SELECT * FROM dish WHERE startDate= :startDate"
        );

        //2-j'execute la requete avec l'id comme parametre
        $requete->execute(array("startDate" => $startDate));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat 
        $dish = $requete->fetchObject("Dish");

        return $dish;
    }

    /*
     * la function recupere un plat dujour ($dish)   de sa date de disponibilité($startDate)*/

    public function getMainDishByDate($startDate)
    {
        //recuperer le plat apartir de son id.

        //1-preparer ma requete
        $requete = $this->connection->prepare(
            "SELECT * FROM dish WHERE startDate <= :startDate AND endDate >= :startDate AND typeOfDish=8"
        );

        //2-j'execute la requete avec l'id comme parametre
        $requete->execute(array("startDate" => $startDate));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat 
        $dish = $requete->fetchObject("Dish");

        return $dish;
    }

    /*
         * la function recupere entree ($dish) de sa date de disponibilité($startDate)*/

    public function getEntreByDate($startDate)
    {
        //recuperer le plat apartir de son id.

        //1-preparer ma requete
        $requete = $this->connection->prepare(
            "SELECT * FROM dish WHERE startDate <= :startDate AND endDate >= :startDate AND typeOfDish=1"
        );

        //2-j'execute la requete avec l'id comme parametre
        $requete->execute(array("startDate" => $startDate));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat 
        $dish = $requete->fetchObject("Dish");

        return $dish;
    }


    public function getTypeDishByDate($typeOfDish, $startDate)
    {
        //recuperer le plat apartir de son id.

        //1-preparer ma requete
        $requete = $this->connection->prepare(
            "SELECT * FROM dish WHERE startDate <= :startDate AND endDate >= :startDate AND typeOfDish =:typeOfDish"
        );

        //2-j'execute la requete avec l'id comme parametre
        $requete->execute(array("startDate" => $startDate, "typeOfDish" => $typeOfDish));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat 
        $dish = $requete->fetchObject("Dish");

        return $dish;
    }

    /*
     * la function recupere desert ($dish) de sa date de disponibilité($startDate)*/

    public function getDesertByDate($startDate)
    {
        //recuperer le plat apartir de son id.

        //1-preparer ma requete
        $requete = $this->connection->prepare(
            "SELECT * FROM dish WHERE startDate <= :startDate AND endDate >= :startDate AND typeOfDish=7"
        );

        //2-j'execute la requete avec l'id comme parametre
        $requete->execute(array("startDate" => $startDate));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat 
        $dish = $requete->fetchObject("Dish");

        return $dish;
    }

    public function getVeggiDishByDate($startDate)
    {
        //recuperer le plat apartir de son id.

        //1-preparer ma requete
        $requete = $this->connection->prepare(
            "SELECT * FROM dish WHERE startDate <= :startDate AND endDate >= :startDate AND typeOfDish=9"
        );

        //2-j'execute la requete avec l'id comme parametre
        $requete->execute(array("startDate" => $startDate));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat 
        $dish = $requete->fetchObject("Dish");

        return $dish;
    }

    /*
     * la function insere un plat(dish) en fonction de tous ces parametres(
     * $name:nom du plat,
     *  $description: ingredients du plat, 
     * $price:prix du plat,
     *  $startDate: date de debout de la disponibilité du plat, 
     * $endDate:date de fin de la disponibilité du plat, 
     * $publication:true si il est publié en ligne sinon false,
     *  $typeOfDish: nombre entier representent la categorie du plat cf README)
     * */

    public function insertDish($name, $description, $price, $startDate, $endDate, $preview, $typeOfDish)
    {
        $requete_prepare = $this->connection->prepare(
            "INSERT INTO dish (name, description, price, startDate, endDate, preview, typeOfDish) VALUE (:name, :description, :price, :startDate, :endDate, :preview, :typeOfDish)"
        );
        $requete_prepare->execute(
            array("name" => $name, "description" => $description, "price" => $price, "startDate" => $startDate, "endDate" => $endDate, "preview" => $preview, "typeOfDish" => $typeOfDish)
        );

        return;
    }


    public function updateDish($name, $description, $price, $startDate, $endDate, $preview, $typeOfDish, $id)
    {
        $requete_prepare = $this->connection->prepare(
            "update dish set name= :name, description= :description,price= :price,startDate= :startDate, endDate= :endDate,preview= :preview,typeOfDish= :typeOfDish where id= :id"
        );
        $requete_prepare->execute(
            array("name" => $name, "description" => $description, "price" => $price, "startDate" => $startDate, "endDate" => $endDate, "preview" => $preview, "typeOfDish" => $typeOfDish, "id" => $id)
        );


    }

    //  deleter le plat(dish) lui-meme

    public function deleteDish($id)
    {
        $requete_prepare = $this->connection->prepare(
            "DELETE FROM dish 
            WHERE id =:id"
        );
        $requete_prepare->execute(array(":id" => $id));

        return true;
    }

    /*-------------------*****************************--------------
        ------------------------****add Dish Week ****-----------------
        ----------------------****************************-------------*/


    public function insertDishWeek($name, $description, $price, $startDate, $endDate, $preview, $typeOfDish)
    {
        $requete_prepare = $this->connection->prepare(
            "INSERT INTO dish(name, description, price, startDate, endDate , preview , typeOfDish) VALUES (:name, :description, :price, :startDate, :endDate , :preview , :typeOfDish )"
        );
        $requete_prepare->execute(
            array("name" => $name, "description" => $description, "price" => $price, "startDate" => $startDate, "endDate" => $endDate, "preview" => $preview, "typeOfDish" => $typeOfDish)

        );
    }

    /*-------------------*****************************--------------
        ------------------------****get Dish By Id ****-----------------
        ----------------------****************************-------------*/

    public function getDishByWeek($startDate, $endDate)
    {
        $requete_prepare = $this->connection->prepare(
            "SELECT * FROM dish WHERE startDate= :startDate, endDate= :endDate"
        );
        $requete_prepare->execute(
            array("startDate" => $startDate, "endDate" => $endDate));

        //3-je recupere l'odjet plat apartir de son id et il me return le plat
        $dishWeek = $requete_prepare->fetchObject("Dish");

        return $dishWeek;


    }

    /*-------------------*****************************--------------
    ------------------------****add reservation****-----------------
    ----------------------****************************-------------*/

    /*
     * la function recupere la reservation($reservation) d'un utilisateur($user) a une date donné($date)
     */

    public function getUserBooking($user, $date)
    {
        if ($user instanceof User) {
            $user = $user->getId();
        }
        /* recuperer la reservation apartir de user et date de la reservation
        1- prepare la requete*/
        $requete_prepare = $this->connection->prepare(
            "SELECT * 
            FROM booking
            WHERE idUser = :id and date = :date"
        );
        /* 2- j'excute la requete avec idUser et le date */
        $requete_prepare->execute(array(":id" => $user, "date" => $date));
        /*3- je requpere l'odjet reservation apartir de la date
        - je requpere  l'objet reservation  apartir de  la classe user et return  */
        $reservation = $requete_prepare->fetchObject("Booking");

        return $reservation;
    }

    /**
     * la function recupere toutes les reservations($reservations) a une date donnée($date)
     */

    public function getBookingsByDate($date)
    {
        /*recuperer toutes les reservations apatir de la date 
        1- prepare la requete*/
        $requete_prepare = $this->connection->prepare(
            "SELECT *  
               FROM booking
               WHERE  date = :date"
        );
        /* 2- j'excute la requete avec la date  */
        $requete_prepare->execute(array("date" => $date));
        /*3- je requpere toutes les reservations*/
        $reservations = $requete_prepare->fetchAll(PDO::FETCH_CLASS, "Booking");
        return $reservations;
    }

    /*
     * la function insere la reservation de l'utilisateur($idUser) a une date donné($date) en function de la categorie du plat($typeOfDish: nombre entier cf README)
     */
    public function insertBooking($idUser, $date, $typeOfDish)
    {
        $requete_prepare = $this->connection->prepare(
            "INSERT INTO booking(idUser, date, typeOfDish) VALUE (:idUser, :date, :typeOfDish)"
        );
        $requete_prepare->execute(array("idUser" => $idUser, "date" => $date, "typeOfDish" => $typeOfDish));
        return true;
    }
    /* 
    * modifie un plat($dish a referaire todo) 
    */

    /*
     * modifie un utilisateur($user)
     */

    public function updateUser($id, $password, $lastname, $firstname)
    {
        $requete_prepare = $this->connection->prepare(
            "UPDATE user SET
            password = :password,
            lastname = :lastname,
            firstname = :firstname
            WHERE id = :id"
        );
        $requete_prepare->execute(
            array(
                "password" => $password,
                "lastname" => $lastname,
                "firstname" => $firstname,
                "id" => $id
            )
        );
        return true;
    }

    /*
     * modifie une reservation($booking) 
     */
    public function updatebooking($idUser, $dateReservation, $typeOfDish)
    {
        $requete_prepare = $this->connection->prepare(
            "UPDATE booking SET
            date = :dateReservation,
            typeOfDish = :typeOfDish
            WHERE idUser = :id"
        );
        $requete_prepare->execute(
            array(
                "dateReservation" => $dateReservation,
                "typeOfDish" => $typeOfDish,
                "id" => $idUser
            )
        );
        //chercher un erreur
        $error = $requete_prepare->errorInfo();
        return true;
    }

    // Compte le nombre de reservation en fonction de la date et du type de plat
    public function getNumberDish($dateReservation, $typeOfDish)
    {
        $requete_prepare = $this->connection->prepare(
            "SELECT COUNT(*) FROM booking where date = :dateReservation AND typeOfDish = :typeOfDish"
        );
        $requete_prepare->execute(
            array(
                "dateReservation" => $dateReservation,
                "typeOfDish" => $typeOfDish
            )
        );
        $result = $requete_prepare->fetch();
        return $result[0];
    }

    //  deleter le plat(dish) lui-meme


    public function deleteUser($id)
    {
        // 1) deleter les dépendances de User : toutes les réservation du user
        $this->deleteUserBooking($id);

        // 2) deleter le user lui-meme
        $requete_prepare = $this->connection->prepare(
            "DELETE FROM user 
                WHERE id =:idUser"
        );
        $requete_prepare->execute(array(":idUser" => $id));
        return true;

    }

    // 2) deleter le reservation de l'utilisateur(booking)
    public function deleteUserBooking($idUser, $date)
    {
        $requete_prepare = $this->connection->prepare(
            "DELETE FROM booking 
                WHERE idUser =:idUser
                AND
                date=:date"

        );
        $requete_prepare->execute(array(
            "idUser" => $idUser,
            "date" => $date
        ));

    }

    /*
     * function qui change l'état de connexion de l'utilisateur
     */
    public function activateUser($id)
    {
        $requete_prepare = $this->connection->prepare(
            "UPDATE user
        SET activeUser = 1
        WHERE id :id "
        );
        $requete_prepare->execute(array(":id" => $id));
    }

    public function getAllTodayDish($id, $date)
    {
        $requete_prepare = $this->connection->prepare(
            "SELECT *  
            FROM booking
            WHERE  date = :date('d-m"
        );
        /* 2- j'excute la requete avec la date  */
        $requete_prepare->execute(array("date" => $date));
        /*3- je requpere toutes les reservations*/
        $reservations = $requete_prepare->fetchAll(PDO::FETCH_CLASS, "Booking");
        return $reservations;
    }

    public function verifierSeulEmail($email){

        $requete_prepare = $this->connection->prepare(
            "SELECT COUNT(email)
            FROM user
            WHERE  email = :email"
        );

        $requete_prepare->execute(array("email" => $email));

        $res = $requete_prepare->fetch();
        
        return $res['COUNT(email)'];

    }
}

?>
