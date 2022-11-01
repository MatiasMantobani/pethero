<?php
namespace Controllers;

use DAO\UserImageDAO as UserImageDAO;
use Models\UserImage as UserImage;
use Controllers\UserController as UserController;

class UserImageController
{
    private $userImageDAO;

    public function __construct()
    {
        $this->userImageDAO = new UserImageDAO();
    }

    public function ShowUploadView()
    {
        require_once(VIEWS_PATH."user-image-upload.php");
    }

    public function ShowImage($userid)
    {
        return $this->userImageDAO->getByUserId($userid);

    }

    public function Upload($file)
    {
        try
        {
            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];

            $filePath = USER_UPLOADS_PATH.basename($fileName);


            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName);

            if($imageSize !== false)
            {
                if (move_uploaded_file($tempFileName, $filePath))
                {
                    $image = new UserImage();
                    $image->setName($fileName);
                    $image->setUserid($_SESSION['userid']);
                    $this->userImageDAO->Add($image);

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

        $userController = new UserController();
        $userController->ShowProfileView();
    }
}
?>