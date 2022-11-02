<?php
namespace Controllers;

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

    public function ShowUploadView($petid)
    {
        require_once(VIEWS_PATH."vacunation-image-upload.php");
    }

    public function ShowImage($petid)
    {
        $vacunationImage = $this->vacunationImageDAO->GetByPetId($petid);
        return $vacunationImage;
    }

    public function Upload($file, $petid)
    {
        try
        {
            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];

            $filePath = VACUNATION_UPLOADS_PATH.basename($fileName);


            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName);

            if($imageSize !== false)
            {
                if (move_uploaded_file($tempFileName, $filePath))
                {
                    $image = new VacunationImage();
                    $image->setName($fileName);
                    $image->setPetid($petid);

                    if ($this->vacunationImageDAO->GetByPetId($petid)){
                        $this->vacunationImageDAO->Update($image);
                    } else {
                        $this->vacunationImageDAO->Add($image);
                    }

                    $message = "Imagen subida correctamente";
                }
                else
                    $message = "Ocurrió un error al intentar subir la imagen";
            }
            else
                $message = "El archivo no corresponde a una imágen";
        }
        catch(Exception $ex)
        {
            $message = $ex->getMessage();
        }

        $petController = new PetController();
        $petController->ShowProfileView($petid);
    }
}
?>