<?php

/**
 * Liste de type de dish
 */

const ENTREE_TYPE = 1;
const SALAD_TYPE = 2;
const SOUPE_TYPE = 3;
const SANDWICH_TYPE = 4;
const PANINI_TYPE = 5;
const PATES_TYPE = 6;
const DESSERT_TYPE = 7;
const PLAT_DU_JOUR_TYPE = 8;
const PLAT_VEGETARIEN_TYPE = 9;

const INT_TO_DISH = array(
    ENTREE_TYPE => 'Entrée',
    SALAD_TYPE => 'Salade',
    SOUPE_TYPE => 'Soupe',
    SANDWICH_TYPE => 'Sandwich',
    PANINI_TYPE => 'Panini',
    PATES_TYPE => 'Pâtes',
    DESSERT_TYPE => 'Dessert',
    PLAT_DU_JOUR_TYPE => 'Plat du jour',
    PLAT_VEGETARIEN_TYPE => 'Plat végétarien'
);

class Dish
{
    private $id;
    private $name;
    private $type;
    private $price;
    private $description;
    private $startDate;
    private $endDate;

    public function __set($name, $value)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($EndtDate)
    {
        $this->endDate = $endDate;
    }

    public function getDishLabel()
    {
        return INT_TO_DISH[$this->type];
    }
}

?>