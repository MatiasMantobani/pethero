<?php
namespace Controllers;

use DAO\MascotaDAO as MascotaDAO;
use Models\Mascota as Mascota;

class MascotaController
{
    private $mascotaDAO;

    public function __construct()
    {
        $this->mascotaDAO = new MascotaDAO();
    }

    public function ShowAddView()
    {
        require_once (VIEWS_PATH . "mascota-add.php");
    }

    public function ShowListView()
    {
        $mascotaList = $this->mascotaDAO->GetAll();

        require_once (VIEWS_PATH . "mascota-list.php");
    }

    public function Add($petName, $foto, $carnetVacunas, $observaciones, $raza, $tamano, $video)

    {
        $mascota = new Mascota(NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $mascota->setPetName($petName);
        $mascota->setFoto($foto);
        $mascota->setCarnetVacunas($carnetVacunas);
        $mascota->setObservaciones($observaciones);
        $mascota->setRaza($raza);
        $mascota->setTamano($tamano);
        $mascota->setVideo($video);

        $this->mascotaDAO->Add($mascota);

        $this->ShowListView();
    }
}