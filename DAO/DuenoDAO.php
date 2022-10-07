<?php

namespace DAO;

use DAO\IDuenoDAO as IDuenoDAO;
use Models\Dueno as Dueno;

class DuenoDAO implements IDuenoDAO
{
    private $duenoList = array();   //este arreglo se llena cada vez que se hace el retrieve data

    public function Add(Dueno $dueno)
    {
        $this->RetrieveData();
        array_push($this->duenoList, $dueno);
        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();
        return $this->duenoList;
    }

    //$firstName, $lastName, $dni, $adress, $telephone, $email, $password,$mascotas,$reservas,$pagos
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->duenoList as $dueno) {
            $valuesArray["firstName"] = $dueno->getFirstName();
            $valuesArray["lastName"] = $dueno->getLastName();
            $valuesArray["dni"] = $dueno->getDNI();
            $valuesArray["adress"] = $dueno->getAdress();
            $valuesArray["telephone"] = $dueno->getTelephone();
            $valuesArray["email"] = $dueno->getEmail();
            $valuesArray["password"] = $dueno->getPassword();
            $valuesArray["mascotas"] = $dueno->getMascotas();
            $valuesArray["reservas"] = $dueno->getReservas();
            $valuesArray["pagos"] = $dueno->getPagos();
            $valuesArray["tipoDeUsuario"] = $dueno->getTipoDeUsuario();
            // $valuesArray["ID"] = $dueno->getID();
            // echo "DAO DUENO SAVE DATA".$valuesArray["ID"] = $dueno->getID(); //DEBUG
            // echo "<br>";
            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/duenos.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->duenoList = array();

        if (file_exists('Data/duenos.json')) {
            $jsonContent = file_get_contents('Data/duenos.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                $dueno = new Dueno();
                $dueno->setFirstName($valuesArray["firstName"]);
                $dueno->setLastName($valuesArray["lastName"]);
                $dueno->setDNI($valuesArray["dni"]);
                $dueno->setAdress($valuesArray["adress"]);
                $dueno->setTelephone($valuesArray["telephone"]);
                $dueno->setEmail($valuesArray["email"]);
                $dueno->setPassword($valuesArray["password"]);
                $dueno->setMascotas($valuesArray["mascotas"]);
                $dueno->setReservas($valuesArray["reservas"]);
                $dueno->setPagos($valuesArray["pagos"]);
                $dueno->setTipoDeUsuario($valuesArray["tipoDeUsuario"]);
                
                // $dueno->setID($valuesArray["ID"]);
                // echo "DAO DUENO RETRIEVE DATA".$valuesArray["ID"] = $dueno->getID(); //DEBUG
                // echo "<br>";
                array_push($this->duenoList, $dueno);
            }
        }
    }
}
