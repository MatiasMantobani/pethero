<?php
    namespace Controllers;

    use DAO\PetDAO as PetDAO;
    use Models\Pet as Pet;
    use Controllers\UserController as UserController;
    use Controllers\BreedController as BreedController;

    class PetController
    {
        private $petDAO;

        public function __construct()
        {
            $this->petDAO = new PetDAO();
            $this->breedController = new BreedController();
        }

        public function ShowProfileView($petid)
        {
            $pet = $this->petDAO->GetByPetId($petid);
            $breedid = $pet->getBreedid();
            $breed = $this->breedController->getByBreedId($breedid);
            require_once(VIEWS_PATH."pet-profile.php");
        }

        public function ShowAddView($name, $type, $observations)
        {
            require_once(VIEWS_PATH."pet-add.php");
        }

        public function ShowPreAddView()
        {
            require_once(VIEWS_PATH."pet-preadd.php");
        }

        public function ShowUpdateView($petid)
        {
            $pet = $this->petDAO->GetByPetId($petid);
            require_once(VIEWS_PATH."pet-update.php");
        }

        public function ShowListView()
        {
            $petList = $this->petDAO->GetByUserid($_SESSION['userid']);
            require_once(VIEWS_PATH."pet-list.php");
        }

        public function Add($breedid, $name, $observations)
        {
                $pet = new Pet();

                $pet->setUserid($_SESSION['userid']);
                $pet->setBreedid($breedid);
                $pet->setName($name);
                $pet->setObservations($observations);

                $this->petDAO->Add($pet);

                $_SESSION['message'] = "Mascota modificada con exito";

                $userController = new UserController();
                $userController->ShowProfileView();
        }

        public function Update($petid, $breedid, $name, $observations){

                $this->petDAO->Remove($petid);
                $this->Add($breedid, $name, $observations);
        }

        public function PetFinder($petid){
            return $this->petDAO->GetByPetId($petid);
        }

        public function GetByUserId($userid){
            $petList = $this->petDAO->GetByUserId($userid);
            if ($petList){
                return $petList;
            }else{
                return null;
            }
        }

        public function Remove($petid){
            $this->petDAO->Remove($petid);

            $_SESSION['message'] = "Mascota quitada con exito";

            $userController = new UserController();
            $userController->ShowProfileView();
        }

    }
?>