<?php

class Booking
{
    private $id;
    private $typeOfDish;
    private $idUser;
    private $date;


    public function getTypeOfDish()
    {
        return $this->typeOfDish;
    }

    public function setTypeOfDish($typeOfDish)
    {
        $this->typeOfDish = $typeOfDish;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setUser($user)
    {
        $this->user = $user;

    }

}


?>