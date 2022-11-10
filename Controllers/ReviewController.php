<?php
namespace Controllers;
use DAO\ReviewDAO as ReviewDAO;
use Models\Review as Review;


class ReviewController
{
    private $reviewDAO;

    public function __construct()
    {
        $this->reviewDAO = new ReviewDAO();
    }

    public function ShowAddView(/*$receptor, $reserveid*/)
    {
        require_once(VIEWS_PATH . "review-add.php");
    }

    public function Add($rating, $comment) //$receptorid, $reserveid, => Agregarlo cuando este en el boton del dueno
    {
        var_dump($comment, $rating);
        $review = new Review();

//        $review->setEmitterid($_SESSION['userid']);
    //    $review->setReceptorid($receptorid);
    //    $review->setReserveid($reserveid);
        $review->setRating($rating);
        $review->setComment($comment);

        $this->reviewDAO->Add($review);

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