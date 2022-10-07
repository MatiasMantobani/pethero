<?php
    namespace DAO;

    use DAO\IGuardianDAO as IGuardianDAO;
    use Models\Guardian as Guardian;

    class GuardianDAO implements IGuardianDAO
    {
        private $guardianList = array();

        public function Add(Guardian $guardian)
        {
            $this->RetrieveData();
            array_push($this->guardianList, $guardian);
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->guardianList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->guardianList as $guardian)
            {
                $valuesArray["firstName"] = $guardian->getFirstName();
                $valuesArray["lastName"] = $guardian->getLastName();
                $valuesArray["dni"] = $guardian->getDNI();
                $valuesArray["adress"] = $guardian->getAdress();
                $valuesArray["telephone"] = $guardian->getTelephone();
                $valuesArray["email"] = $guardian->getEmail();
                $valuesArray["password"] = $guardian->getPassword();
                $valuesArray["cuil"] = $guardian->getCuil();
                $valuesArray["remuneracion"] = $guardian->getRemuneracion();
                $valuesArray["reputacion"] = $guardian->getReputacion();
                $valuesArray["tamanoDeMascota"] = $guardian->getTamanoDeMascota();
                $valuesArray["disponibilidad"] = $guardian->getDisponibilidad();
                $valuesArray["reservas"] = $guardian->getReservas();
                $valuesArray["reviews"] = $guardian->getReviews();
                $valuesArray["tipoDeUsuario"] = $guardian->getTipoDeUsuario();
                // $valuesArray["ID"] = $guardian->getID();
                // echo "DAO GUARDIAN SAVE DATA".$valuesArray["ID"] = $guardian->getID(); //DEBUG
                // echo "<br>";
                array_push($arrayToEncode, $valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents('Data/guardianes.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->guardianList = array();

            if(file_exists('Data/guardianes.json'))
            {
                $jsonContent = file_get_contents('Data/guardianes.json');
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $guardian = new Guardian();
                    
                    $guardian->setFirstName($valuesArray["firstName"]);
                    $guardian->setLastName($valuesArray["lastName"]);
                    $guardian->setDNI($valuesArray["dni"]);
                    $guardian->setAdress($valuesArray["adress"]);
                    $guardian->setTelephone($valuesArray["telephone"]);
                    $guardian->setEmail($valuesArray["email"]);
                    $guardian->setPassword($valuesArray["password"]);
                    $guardian->setCuil($valuesArray["cuil"]);
                    $guardian->setRemuneracion($valuesArray["remuneracion"]);
                    $guardian->setReputacion($valuesArray["reputacion"]);
                    $guardian->setTamanoDeMascota($valuesArray["tamanoDeMascota"]);
                    $guardian->setDisponibilidad($valuesArray["disponibilidad"]);
                    $guardian->setReservas($valuesArray["reservas"]);
                    $guardian->setReviews($valuesArray["reviews"]);
                    $guardian->setTipoDeUsuario($valuesArray["tipoDeUsuario"]);
                    // $guardian->setID($valuesArray["ID"]);
                    // echo "DAO GUARDIAN RETRIEVE DATA".$valuesArray["ID"] = $guardian->getID(); //DEBUG
                    // echo "<br>";
                    array_push($this->guardianList, $guardian);
                }
            }
        }
    }
