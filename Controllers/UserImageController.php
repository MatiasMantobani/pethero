<?php

namespace Controllers;

use \Exception as Exception;
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

    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }

    public function ShowUploadView()
    {
        if ($this->validate()) {
            require_once(VIEWS_PATH . "user-image-upload.php");
        }
    }

    public function ShowImage($userid)
    {
        if ($this->validate()) {
            return $this->userImageDAO->getByUserId($userid);

        }
    }

    public function Upload($file)
    {
        $userController = new UserController();
        if ($file["name"] != "") {
            try {
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                $filePath = USER_UPLOADS_PATH . basename($fileName);
                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $imageSize = getimagesize($tempFileName);

                if ($imageSize !== false) {
                    if (move_uploaded_file($tempFileName, $filePath)) {
                        $image = new UserImage();
                        $image->setName($fileName);
                        $image->setUserid($_SESSION['userid']);
                        if ($this->userImageDAO->GetByUserId($_SESSION['userid'])) {
                            $this->userImageDAO->Update($image);
                        } else {
                            $this->userImageDAO->Add($image);
                        }
                        $_SESSION['message'][] = "Imagen subida correctamente";
                        $userController->ShowProfileView();
                    } else
                        $_SESSION['message'][] = "Ocurrió un error al intentar subir la imagen";
                    $userController->ShowProfileView();
                } else
                    $_SESSION['message'][] = "El archivo no corresponde a una imágen";
                $userController->ShowProfileView();
            } catch (Exception $ex) {
                $_SESSION['message'][] = "Ocurrió un error al intentar subir la imagen";
                $userController->ShowProfileView();
            }
        } else {
            $_SESSION['message'][] = "No se cargo ninguna imagen";
            $userController->ShowProfileView();
        }
    }
}

?>