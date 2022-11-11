<?php
namespace Controllers;
use DAO\ReviewDAO as ReviewDAO;
use Models\Review as Review;
use Controllers\ReserveController as Reserve;


class ReviewController
{
    private $reviewDAO;

    public function __construct()
    {
        $this->reviewDAO = new ReviewDAO();
    }

    public function ShowAddView($reserveid)
    {
        $reserva = $reserveid;
        require_once(VIEWS_PATH . "review-add.php");
    }

    public function Add($rating, $comment, $reserveid) //$receptorid, $reserveid, => Agregarlo cuando este en el boton del dueno
    {
        $review = new Review();

        $reserveController = new Reserve();
        $reserva = $reserveController->getReserveById($reserveid);

        $review->setEmitterid($_SESSION['userid']);
        $review->setReceptorid($reserva->getReceiverid());
        $review->setReserveid($reserveid);
        $review->setRating((int)$rating);
        $review->setComment($comment);

        $this->reviewDAO->Add($review);
    }

    public function AddWithCheck($rating, $comment, $reserveid){
        if(!$this->reviewDAO->GetByReserveid($reserveid)){
            $this->Add($rating, $comment, $reserveid);
            $_SESSION['message'] = "Tu review se envio correctamente";
        }else{
            $_SESSION['message'] = "No puedes enviar la review, ya que dejaste una previamente";
        }
        $controller = new UserController();
        $controller->ShowProfileView();
    }

    public function ReviewFinderByEmitter($userid)
    {
        return $this->reviewDAO->GetByEmitterid($userid);
    }
    public function ReviewFinderByTransmitter($userid)
    {
        return $this->reviewDAO->GetByReceptorid($userid);
    }

    public function ReviewFinderByReserve($reserveid)
    {
        return $this->reviewDAO->GetByReserveid($reserveid);
    }

}