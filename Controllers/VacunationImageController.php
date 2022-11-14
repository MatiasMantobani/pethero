<?php

namespace Controllers;

use \Exception as Exception;
use DAO\VacunationImageDAO as VacunationImageDAO;
use Models\VacunationImage as VacunationImage;
use Controllers\PetController as PetController;

class VacunationImageController
{
    private $vacunationImageDAO;

    public function __construct()
    {
        $this->vacunationImageDAO = new VacunationImageDAO();
    }

    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }

    public function ShowUploadView($petid)
    {
        if ($this->validate()) {
            require_once(VIEWS_PATH . "vacunation-image-upload.php");
        }
    }

    public function ShowImage($petid)
    {
        if ($this->validate()) {
            try {
                $vacunationImage = $this->vacunationImageDAO->GetByPetId($petid);
                return $vacunationImage;
            } catch (Exception $ex) {
                $_SESSION["message"] = "error al Mostrar el Carnet de Vacunacion";
            }
        }
    }

    public function Upload($file, $petid)
    {
        if ($this->validate()) {
            $petController = new PetController();
            if ($file["name"] != "") {
                try {
                    $fileName = $file["name"];
                    $tempFileName = $file["tmp_name"];
                    $type = $file["type"];
                    $filePath = VACUNATION_UPLOADS_PATH . basename($fileName);
                    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    $imageSize = getimagesize($tempFileName);

                    if ($imageSize !== false) {
                        if (move_uploaded_file($tempFileName, $filePath)) {
                            $image = new VacunationImage();
                            $image->setName($fileName);
                            $image->setPetid($petid);

                            if ($this->vacunationImageDAO->GetByPetId($petid)) {
                                $this->vacunationImageDAO->Update($image);
                            } else {
                                $this->vacunationImageDAO->Add($image);
                            }

                            $_SESSION['message'] = "Imagen subida correctamente";
                            $petController->ShowProfileView($petid);
                        } else
                            $_SESSION['message'] = "Ocurrió un error al intentar subir la imagen";
                        $petController->ShowProfileView($petid);
                    } else
                        $_SESSION['message'] = "El archivo no corresponde a una imágen";
                    $petController->ShowProfileView($petid);
                } catch (Exception $ex) {
                    $_SESSION['message'] = $ex->getMessage();
                    $petController->ShowProfileView($petid);
                } 
            }else {
                $_SESSION['message'] = "No se cargo ninguna imagen";

                $petController->ShowProfileView($petid);
            }
        }
    }
}
