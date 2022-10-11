<?php

namespace DAO;

use DAO\IMascotaDAO as IMascotaDAO;
use Models\Mascota as Mascota;

class MascotaDAO implements IMascotaDAO
{
    private $mascotaList = array();

    public function Add(Mascota $mascota)
    {
        $this->RetrieveData();
        array_push($this->mascotaList, $mascota);
        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();
        return $this->mascotaList;
    }
    //$petName, $foto, $carnetVacunas, $observaciones, $raza, $tamano, $video
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->mascotaList as $mascota) {

            $valuesArray["idDueno"] = $mascota->getIdDueno();
            $valuesArray["petName"] = $mascota->getPetName();
            $valuesArray["foto"] = $mascota->getFoto();
            $valuesArray["carnetVacunas"] = $mascota->getCarnetVacunas();
            $valuesArray["observaciones"] = $mascota->getObservaciones();
            $valuesArray["raza"] = $mascota->getRaza();
            $valuesArray["tamano"] = $mascota->getTamano();
            $valuesArray["video"] = $mascota->getVideo();

            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/mascotas.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->mascotaList = array();

        if (file_exists('Data/mascotas.json')) {
            $jsonContent = file_get_contents('Data/mascotas.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {

                $mascota = new Mascota();

                $mascota->setIdDueno($valuesArray["idDueno"]);
                $mascota->setPetName($valuesArray["petName"]);
                $mascota->setFoto($valuesArray["foto"]);
                $mascota->setCarnetVacunas($valuesArray["carnetVacunas"]);
                $mascota->setObservaciones($valuesArray["observaciones"]);
                $mascota->setRaza($valuesArray["raza"]);
                $mascota->setTamano($valuesArray["tamano"]);
                $mascota->setVideo($valuesArray["video"]);

                array_push($this->mascotaList, $mascota);
            }
        }
    }
}
