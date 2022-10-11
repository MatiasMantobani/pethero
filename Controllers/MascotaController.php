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
        // require_once(VIEWS_PATH . "validate-session.php");
        require_once (VIEWS_PATH . "mascota-add.php");
    }

    public function ShowListView()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        $mascotaList = $this->mascotaDAO->GetAll(); // mascotaList lo usa mascota-list.php en el foreach($mascotaList as $mascota)
        require_once (VIEWS_PATH . "mascota-list.php");
    }

    public function Add($petName, $foto, $carnetVacunas, $observaciones, $raza, $tamano, $video)

    {
        require_once(VIEWS_PATH . "validate-session.php");

        $mascota = new Mascota();
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