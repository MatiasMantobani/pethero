<?php

namespace Controllers;

use Controllers\MessageController as MessageController;
use \Exception as Exception;
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


    // 0 : dadas de baja
    // 1 : sin carnet, no puede hacer reservas
    // 2 : disponible
    //carga y muestra mascotas en navbar dueño
    public function ShowListView()
    {
        if ($this->validate() && $this->validateOwner()) {
            try {
                $petList = $this->petDAO->GetMyPets($_SESSION['userid']);  //muestra las sin carnet y disponibles
                $breeds = array();
                $breedController = new BreedController();
                foreach ($petList as $pet) {
                    array_push($breeds, $breedController->getByBreedId($pet->getBreedid()));
                }

                //para evitar mostrar una lista vacia
                if (count($petList) > 0) {
                    require_once(VIEWS_PATH . "pet-list.php");
                } else {
                    MessageController::add("No tienes mascotas para mostrar");
                    $userController = new UserController();
                    $userController->ShowProfileView();
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Mostrar Lista de Mascotas");
            }
        }
    }


    //dadas de baja
    public function GetMyDischarged($userid)
    {
        if ($this->validate()) {
            try {
                $petList = $this->petDAO->GetByUseridAndStatus($_SESSION['userid'], 0);
                if ($petList) {
                    return $petList;
                } else {
                    return null;
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir mis Mascota Descartadas");
            }
        }
    }


    //no pueden hacer reservas
    public function GetMyPaused($userid)
    {
        if ($this->validate()) {
            try {
                $petList = $this->petDAO->GetByUseridAndStatus($_SESSION['userid'], 1);
                if ($petList) {
                    return $petList;
                } else {
                    return null;
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir mis Mascotas Pausadas");
            }
        }
    }


    // pueden hacer reservas
    public function GetMyActive($userid)
    {
        if ($this->validate()) {
            try {
                $petList = $this->petDAO->GetByUseridAndStatus($_SESSION['userid'], 2);
                if ($petList) {
                    return $petList;
                } else {
                    return null;
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir mis Mascotas Activas");
            }
        }
    }


    public function validateStatus($petid)
    {
        if ($this->validate()) {
            try {
                $petImageController = new PetImageController();
                $vacunationImageController = new VacunationImageController();
                $pet = $this->petDAO->GetByPetId($petid);

                if ($petImageController->ShowImage($petid) && $vacunationImageController->ShowImage($petid) && $pet->getStatus() != 0) {
                    $this->petDAO->UpdateStatus($petid, 2);
                } else {
                    $this->petDAO->UpdateStatus($petid, 1);
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Validar Estado de Mascota");
            }
        }
    }


    public function ShowProfileView($petid)
    {
        if ($this->validate()) {
            try {
                $this->validateStatus($petid);

                //para cambiar estado al dueño si completa fotos mascota
                $userController = new UserController();
                $userController->validateStatus();

                $pet = $this->petDAO->GetByPetId($petid);

                $breedid = $pet->getBreedid();
                $breed = $this->breedController->getByBreedId($breedid);

                $petImage = $this->petImageController->ShowImage($pet->getPetid());
                $vacunationImage = $this->vacunationImageController->ShowImage($pet->getPetid());

                if ($petImage == null) {
                    MessageController::add("Para comenzar, subi mi foto");
                }

                if ($vacunationImage == null) {
                    MessageController::add("Subí mi carnet de vacunación");
                }

                $messages = MessageController::getAll();
                MessageController::clear();

                require_once(VIEWS_PATH . "pet-profile.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al Mostrar Perfil de Mascota");
            }
        }
    }


    public function ShowAddView($name, $type, $observations)
    {
        if ($this->validate() && $this->validateOwner() ) {
            try {
                $breedList = $this->breedController->getAllByType($type);
                require_once(VIEWS_PATH . "pet-add.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al Mostrar Agregar Mascota");
            }
        }
    }


    public function ShowPreAddView()
    {
        if ($this->validate() && $this->validateOwner() ) {
            try {
                require_once(VIEWS_PATH . "pet-preadd.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al Mostrar Pre-Agregar Mascota");
            }
        }
    }


    public function ShowUpdateView($petid)
    {
        if ($this->validate() && $this->validateOwner() ) {
            try {
                $pet = $this->petDAO->GetByPetId($petid);
                require_once(VIEWS_PATH . "pet-update.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Mascota");
            }
        }
    }


    public function Add($breedid, $name, $observations)
    {
        if ($this->validate()) {
            try {
                $pet = new Pet();

                $pet->setUserid($_SESSION['userid']);
                $pet->setBreedid($breedid);
                $pet->setName($name);
                $pet->setObservations($observations);

                $this->petDAO->Add($pet);

                MessageController::add("Mascota cargada con exito. No olvides subir al perfil foto y carnet de vacunacion");

                $userController = new UserController();
                $userController->ShowProfileView();
            } catch (Exception $ex) {
                HomeController::Index("Error al Agregar Mascota");
            }
        }
    }


    public function Update($petid, $breedid, $name, $observations)
    {
        if ($this->validate()) {
            try {
                $pet = new Pet();
                $pet->setPetid($petid);
                $pet->setBreedid($breedid);
                $pet->setName($name);
                $pet->setObservations($observations);

                MessageController::add("Mascota modificada con exito");

                $this->petDAO->Update($pet);
                $this->ShowProfileView($pet->getPetid());
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Mascota");
            }
        }
    }


    public function PetFinder($petid)   //retorna 1 mascota
    {
        if ($this->validate()) {
            try {
                return $this->petDAO->GetByPetId($petid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Encontrar Mascota");
            }
        }
    }


    public function Remove($petid)
    {
        if ($this->validate()) {
            try {
                $this->petDAO->Remove($petid);

                MessageController::add("Mascota quitada con exito");

                $userController = new UserController();
                $userController->ShowProfileView();
            } catch (Exception $ex) {
                HomeController::Index("Error al Remover Mascota");
            }
        }
    }
}
