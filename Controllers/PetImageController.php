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

    public function ShowUploadView($petid)
    {
        require_once(VIEWS_PATH."pet-image-upload.php");
    }

    public function ShowImage($petid)
    {
        $petImage = $this->petImageDAO->GetByPetId($petid);
        return $petImage;

    }

    public function Upload($file, $petid)
    {
        try
        {
            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];

            $filePath = PET_UPLOADS_PATH.basename($fileName);


            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName);

            if($imageSize !== false)
            {
                if (move_uploaded_file($tempFileName, $filePath))
                {
                    $image = new PetImage();
                    $image->setName($fileName);
                    $image->setPetid($petid);



                    if ($this->petImageDAO->GetByPetId($petid)){
                        $this->petImageDAO->Update($image);
                    } else {
                        $this->petImageDAO->Add($image);
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