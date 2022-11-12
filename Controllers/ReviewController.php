<?php
namespace Controllers;
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
        $reserveController = new ReserveController();
        $reserveController->Reviewed($reserveid);
        $controller = new UserController();
        $controller->ShowProfileView();
    }

    public function ReviewFinderByEmitter($userid)
    {
        return $this->reviewDAO->GetByEmitterid($userid);
    }
    public function ReviewFinderByReceptor($userid)
    {
        return $this->reviewDAO->GetByReceptorid($userid);
    }

    public function ReviewFinderByReserve($reserveid)
    {
        return $this->reviewDAO->GetByReserveid($reserveid);
    }

    public function ShowReviewList($userid){
        $ratings = $this->ReviewFinderByReceptor($userid);

        $userController = new UserController();
        $user = $userController->GetUserById($userid);

        require_once(VIEWS_PATH . "review-list.php");
    }

    public function GetFinalScore($id, $reviewCounter){
        $ratings = $this->ReviewFinderByReceptor($id);
        $reviewAcum = 0;
        foreach($ratings as $rating){
            $reviewAcum += $rating->getRating();
        }
        if($reviewCounter > 0){
            $finalRating = $reviewAcum/$reviewCounter;
        }else{
            $finalRating = 0;
        }
        return $finalRating;
    }

    public function GetReviewCounter($id){
        $ratings = $this->ReviewFinderByReceptor($id);
        return sizeof($ratings);
    }

}