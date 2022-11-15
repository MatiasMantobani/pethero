<?php

namespace Controllers;

use \Exception as Exception;
use DAO\BreedDAO as BreedDAO;
use Models\Breed as Breed;
use Controllers\UserController as UserController;

class BreedController
{
    private $breedDAO;

    public function __construct()
    {
        $this->breedDAO = new BreedDAO();
    }


    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    public function getByBreedId($breedid)
    {
        if ($this->validate()) {
            try {
                return $this->breedDAO->GetByBreedId($breedid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir Raza");
            }
        }
    }


    public function getAllByType($type)
    {
        if ($this->validate()) {
            try {
                return $this->breedDAO->GetAllByType($type);
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir Razas");
            }
        }
    }
}

/*
if ($this->validate()) {

}

try {

} catch (Exception $ex) {
    HomeController::Index("Error al ... de Raza");
}



*/