<?php

class User
{
    private $id;
    private $lastname;
    private $firstname;
    private $email;
    private $validationKey;
    private $password;
    private $isAdmin;


    public function getId()
    {
        return $this->id;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getvalidationKey()
    {
        return $this->validationKey;
    }

    public function getisAdmin()
    {
        return $this->isAdmin;
    }


}
 