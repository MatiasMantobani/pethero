<?php

namespace Controllers;

use DAO\PetDAO as PetDAO;
use Models\Pet as Pet;
use Controllers\UserController as UserController;
use Controllers\BreedController as BreedController;
use Controllers\PetImageController as PetImageController;
use Controllers\VacunationImageController as VacunationImageController;

class PetController
{
    private $petDAO;
    private $breedController;
    private $petImageController;
    private $vacunationImageController;

    public function __construct()
    {
        $this->petDAO = new PetDAO();
        $this->breedController = new BreedController();
        $this->petImageController = new PetImageController();
        $this->vacunationImageController = new VacunationImageController();
    }

    public function ShowProfileView($petid)
    {
        $pet = $this->petDAO->GetByPetId($petid);

        $breedid = $pet->getBreedid();
        $breed = $this->breedController->getByBreedId($breedid);

        $petImage = $this->petImageController->ShowImage($pet->getPetid());
        $vacunationImage = $this->vacunationImageController->ShowImage($pet->getPetid());

        if (!$petImage){
            $_SESSION['message'] .= "Para comenzar, podés subir mi foto. <br>";
        }

        if (!$vacunationImage){
            $_SESSION['message'] .= "Subí mi carnet de vacunación. <br>";
        }

        require_once(VIEWS_PATH . "pet-profile.php");
    }

    public function ShowAddView($name, $type, $observations)
    {
        $breedList = $this->breedController->getAllByType($type);
        require_once(VIEWS_PATH . "pet-add.php");
    }

    public function ShowPreAddView()
    {
        require_once(VIEWS_PATH . "pet-preadd.php");
    }

    public function ShowUpdateView($petid)
    {
        $pet = $this->petDAO->GetByPetId($petid);
        require_once(VIEWS_PATH . "pet-update.php");
    }

    public function ShowListView()
    {
        $petList = $this->petDAO->GetByUserid($_SESSION['userid']);
        $breedController = new BreedController();
        require_once(VIEWS_PATH . "pet-list.php");
    }

    public function Add($breedid, $name, $observations)
    {
        $pet = new Pet();

        $pet->setUserid($_SESSION['userid']);
        $pet->setBreedid($breedid);
        $pet->setName($name);
        $pet->setObservations($observations);

        $this->petDAO->Add($pet);

        $_SESSION['message'] = "Mascota cargada con exito<br>";

        $userController = new UserController();
        $userController->ShowProfileView();
    }

    //la excepcion de DAO se debe manejhar aca con try-catch

    public function Update($petid, $breedid, $name, $observations)
    {

        // $this->petDAO->Remove($petid);
        // $this->Add($breedid, $name, $observations);

        $pet = new Pet();
        $pet->setPetid($petid);
        $pet->setBreedid($breedid);
        $pet->setName($name);
        $pet->setObservations($observations);

        $_SESSION['message'] = "Mascota modificada con exito<br>";

        $this->petDAO->Update($pet);
        $this->ShowProfileView($pet->getPetid());
    }

    public function PetFinder($petid)   //retorna 1 mascota
    {
        return $this->petDAO->GetByPetId($petid);
    }

    public function GetByUserId($userid)
    {
        $petList = $this->petDAO->GetByUserId($userid);
        if ($petList) {
            return $petList;
        } else {
            return null;
        }
    }

    public function Remove($petid)
    {
        $this->petDAO->Remove($petid);

        $_SESSION['message'] = "Mascota quitada con exito<br>";

        $userController = new UserController();
        $userController->ShowProfileView();
    }
}
