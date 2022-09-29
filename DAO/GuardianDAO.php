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
                    $guardian = new Guardian(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
                    $guardian->setFirstName($valuesArray["firstName"]);
                    $guardian->setLastName($valuesArray["lastName"]);
                    $guardian->setDNI($valuesArray["dni"]);
                    $guardian->setAdress($valuesArray["adress"]);
                    $guardian->setTelephone($valuesArray["telephone"]);
                    $guardian->setEmail($valuesArray["email"]);
                    $guardian->setPassword($valuesArray["password"]);
                    // $guardian->setID($valuesArray["ID"]);

                    // echo "DAO GUARDIAN RETRIEVE DATA".$valuesArray["ID"] = $guardian->getID(); //DEBUG
                    // echo "<br>";
                    array_push($this->guardianList, $guardian);
                }
            }
        }
    }
?>