<?php
    namespace Controllers;

    use DAO\BreedDAO as BreedDAO;
    use Models\Breed as Breed;
    use Controllers\UserController as UserController;

    class BreedController
    {
        private $breedDAO;

        public function __construct()
        {
            $this->breedDAO = new BreedDAO();
        }

        public function getByBreedId($breedid){
            return $this->breedDAO->GetByBreedId($breedid);
        }

        public function getAllByType($type){
            return $this->breedDAO->GetAllByType($type);
        }




    }
?>