<?php

namespace Controllers;

use \Exception as Exception;
use DAO\ReviewDAO as ReviewDAO;
use Models\Keeper;
use Models\Review as Review;
use Controllers\ReserveController as Reserve;


class ReviewController
{
    private $reviewDAO;

    public function __construct()
    {
        $this->reviewDAO = new ReviewDAO();
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

    public function ShowAddView($reserveid)
    {
        if ($this->validate() && $this->validateOwner()) {
            $reserva = $reserveid;
            require_once(VIEWS_PATH . "review-add.php");
        }
    }

    public function Add($rating, $comment, $reserveid) //$receptorid, $reserveid, => Agregarlo cuando este en el boton del dueno
    {
        if ($this->validate()) {
            try {
                $review = new Review();

                $reserveController = new Reserve();
                $reserva = $reserveController->getReserveById($reserveid);

                $review->setEmitterid($_SESSION['userid']);
                $review->setReceptorid($reserva->getReceiverid());
                $review->setReserveid($reserveid);
                $review->setRating((int)$rating);
                $review->setComment($comment);

                $this->reviewDAO->Add($review);
            } catch (Exception $ex) {
                HomeController::Index("Error al enviar la Reseña");
            }
        }
    }

    public function AddWithCheck($rating, $comment, $reserveid)
    {
        if ($this->validate()) {
            try {
                if (!$this->reviewDAO->GetByReserveid($reserveid)) {
                    $this->Add($rating, $comment, $reserveid);
                    MessageController::add("Tu review se envio correctamente");
                } else {
                    MessageController::add("No puedes enviar la review, ya que dejaste una previamente");
                }
                $reserveController = new ReserveController();
                $reserveController->Reviewed($reserveid);
                $controller = new UserController();
                $controller->ShowProfileView();
            } catch (Exception $ex) {
                HomeController::Index("Error al enviar la Reseña");
            }
        }
    }

    public function ReviewFinderByEmitter($userid)
    {
        if ($this->validate()) {
            try {
                return $this->reviewDAO->GetByEmitterid($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al traer las Reseñas");
            }
        }
    }

    public function ReviewFinderByReceptor($userid)
    {
        if ($this->validate()) {
            try {
                return $this->reviewDAO->GetByReceptorid($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al traer las Reseñas");
            }
        }
    }

    public function ReviewFinderByReserve($reserveid)
    {
        if ($this->validate()) {
            try {
                return $this->reviewDAO->GetByReserveid($reserveid);
            } catch (Exception $ex) {
                HomeController::Index("Error al traer las Reseñas");
            }
        }
    }

    public function ShowReviewList($userid)
    {
        if ($this->validate()) {
            $ratings = $this->ReviewFinderByReceptor($userid);

            $userController = new UserController();
            $user = $userController->GetUserById($userid);


            $reserveController = new ReserveController();
            $petController = new PetController();
            $petIds = array();
            $petNames = array();
            $keepersNames = array();

            foreach ($ratings as $rating) {
                array_push($petNames, $petController->PetFinder($reserveController->getReserveById($rating->getReserveid())->getPetid())->getName());
                array_push($petIds, $petController->PetFinder($reserveController->getReserveById($rating->getReserveid())->getPetid())->getPetid());
                array_push($keepersNames, $userController->GetUserById($rating->getEmitterid())->getName());
            }

            if (count($ratings) > 0) {
                require_once(VIEWS_PATH . "review-list.php");
            } else {
                MessageController::add("No tienes reviews para mostrar");
                $userController->ShowProfileView();
            }
        }
    }

    public function GetFinalScore($id, $reviewCounter)
    {
        if ($this->validate()) {

            $ratings = $this->ReviewFinderByReceptor($id);
            $reviewAcum = 0;
            foreach ($ratings as $rating) {
                $reviewAcum += $rating->getRating();
            }
            if ($reviewCounter > 0) {
                $finalRating = $reviewAcum / $reviewCounter;
            } else {
                $finalRating = 0;
            }
            return $finalRating;
        }
    }

    public function GetReviewCounter($id)
    {
        if ($this->validate()) {
            $ratings = $this->ReviewFinderByReceptor($id);
            return sizeof($ratings);
        }
    }
}

/*

if ($this->validate()) {
try {

} catch (Exception $ex) {
    HomeController::Index("Error al ... Reseña");
}
}

*/
