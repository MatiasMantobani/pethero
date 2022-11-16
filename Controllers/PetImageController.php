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

    public function validateOwner()
    {
        if ($_SESSION["type"] == "D") {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }

    public function ShowUploadView($petid)
    {
        if ($this->validate() && $this->validateOwner() ) {
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
                MessageController::add("Error al mostrar carnet");
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

                            MessageController::add("Imagen subida correctamente");
                            $petController->ShowProfileView($petid);
                        } else
                            MessageController::add("Ocurrió un error al intentar subir la imagen");
                        $petController->ShowProfileView($petid);
                    } else
                        MessageController::add("El archivo no corresponde a una imágen");
                    $petController->ShowProfileView($petid);
                } catch (Exception $ex) {
                    MessageController::add("Error al cargar la imagen");
                    $petController->ShowProfileView($petid);
                }
            } else {
                MessageController::add("No se cargo ninguna imagen");
                $petController->ShowProfileView($petid);
            }
        }
    }
}
