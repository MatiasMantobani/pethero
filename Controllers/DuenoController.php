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
        // require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "dueno-add.php");
    }

    public function ShowListView()
    {
        // require_once(VIEWS_PATH . "validate-session.php");
        $duenoList = $this->duenoDAO->GetAll(); // duenoList lo usa dueno-list.php en el foreach($duenoList as $dueno)
        require_once(VIEWS_PATH . "dueno-list.php");
    }

    public function Add($firstName, $lastName, $dni, $adress, $telephone, $email, $password, $mascotas, $reservas, $pagos)
    {
        // require_once(VIEWS_PATH . "validate-session.php");

        $dueno = new Dueno();

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
