<?php

namespace Controllers;

use \Exception as Exception;
use DAO\PetImageDAO as PetImageDAO;
use Models\PetImage as PetImage;
use Controllers\PetController as PetController;

class PetImageController
{
    private $petImageDAO;

    public function __construct()
    {
        $this->petImageDAO = new PetImageDAO();
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
            require_once(VIEWS_PATH . "pet-image-upload.php");
        }
    }

    public function ShowImage($petid)
    {
        if ($this->validate()) {
            try {
                $petImage = $this->petImageDAO->GetByPetId($petid);
                return $petImage;
            } catch (Exception $ex) {
                $_SESSION["message"][] = "Error al mostrar carnet";
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
                    $filePath = PET_UPLOADS_PATH . basename($fileName);
                    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    $imageSize = getimagesize($tempFileName);

                    if ($imageSize !== false) {
                        if (move_uploaded_file($tempFileName, $filePath)) {
                            $image = new PetImage();
                            $image->setName($fileName);
                            $image->setPetid($petid);

                            if ($this->petImageDAO->GetByPetId($petid)) {
                                $this->petImageDAO->Update($image);
                            } else {
                                $this->petImageDAO->Add($image);
                            }

                            $_SESSION['message'][] = "Imagen subida correctamente";
                            $petController->ShowProfileView($petid);
                        } else
                            $_SESSION['message'][] = "Ocurrió un error al intentar subir la imagen";
                        $petController->ShowProfileView($petid);
                    } else
                        $_SESSION['message'][] = "El archivo no corresponde a una imágen";
                    $petController->ShowProfileView($petid);
                } catch (Exception $ex) {
                    $_SESSION['message'][] = "Error al cargar la imagen";
                    $petController->ShowProfileView($petid);
                }
            } else {
                $_SESSION['message'][] = "No se cargo ninguna imagen";
                $petController->ShowProfileView($petid);
            }
        }
    }
}
