<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

class GuardianController
{
    private $guardianDAO;

    public function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
    }


    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "guardian-add.php");
    }

    public function ShowListView()
    {
        $guardianList = $this->guardianDAO->GetAll();

        require_once(VIEWS_PATH . "guardian-list.php");
    }


    public function Add($firstName, $lastName, $dni, $adress, $telephone, $email, $password, $cuil, $remuneracion, $tamanoDeMascota, $disponibilidad)
    {
        $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $guardian->setFirstName($firstName);
        $guardian->setLastName($lastName);
        $guardian->setDni($dni);
        $guardian->setAdress($adress);
        $guardian->setTelephone($telephone);
        $guardian->setEmail($email);
        $guardian->setPassword($password);
        $guardian->setCuil($cuil);
        $guardian->setRemuneracion($remuneracion);
        $guardian->setTamanoDeMascota($tamanoDeMascota);
        $guardian->setDisponibilidad($disponibilidad);

        $this->guardianDAO->Add($guardian);

        $this->ShowListView();
        // require_once(VIEWS_PATH . "guardian-perfil.php");
    }
}
