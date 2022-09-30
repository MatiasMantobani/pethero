<?php

namespace Controllers;

use DAO\DuenoDAO as DuenoDAO;
use Models\Dueno as Dueno;

class DuenoController
{
    private $duenoDAO;

    public function __construct()
    {
        $this->duenoDAO = new DuenoDAO();
    }



    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "dueno-add.php");
    }

    public function ShowListView()
    {
        $duenoList = $this->duenoDAO->GetAll();

        require_once(VIEWS_PATH . "dueno-list.php");
    }



    public function Add($firstName, $lastName, $dni, $adress, $telephone, $email, $password,$mascotas,$reservas,$pagos )
    {
        $dueno = new Dueno(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $dueno->setFirstName($firstName);
        $dueno->setLastName($lastName);
        $dueno->setDni($dni);
        $dueno->setAdress($adress);
        $dueno->setTelephone($telephone);
        $dueno->setEmail($email);
        $dueno->setPassword($password);
        $dueno->setMascotas($mascotas);
        $dueno->setReservas($reservas);
        $dueno->setPagos($pagos);

        $this->duenoDAO->Add($dueno);

        $this->ShowListView();
    }
}
