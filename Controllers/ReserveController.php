<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use DAO\ReserveDAO;
use Models\Reserve as Reserve;
use DateInterval;
use DateTime;
use Cassandra\Date;
use Controllers\AvailableDateController as AvailableDateController;
use Models\AvailableDate;
use Controllers\UserController as UserController;
use Controllers\KeeperController as KeeperController;
use Controllers\PetController as PetController;

class ReserveController
{
    private $reserveDAO;

    private $UserController;
    private $AvailableDateController;
    private $KeeperController;
    private $PetController;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->PetController = new PetController();
        $this->UserController = new UserController();
        $this->AvailableDateController = new AvailableDateController();
        $this->KeeperController = new KeeperController();
    }

    public function getMyReserves()
    {
        if ($_SESSION["type"] == "D") {
            return $this->reserveDAO->getOwnerReserves($_SESSION['userid']);
        }else if($_SESSION["type"] == "G"){
            return $this->reserveDAO->getKeeperReserves($_SESSION['userid']);
        }else{
            echo "admin";
        }
        
    }

    public function Add($petid, $daterange, $userid)
    {
        $dateArray = explode(",", $daterange);
        $firstdate = new DateTime($dateArray[0]);
        $lastdate = new DateTime($dateArray[1]);

        $reserve = new Reserve();

        $reserve->setTransmitterid($_SESSION['userid']);
        $reserve->setReceiverid($userid);
        $reserve->setPetid($petid);
        $reserve->setFirstdate($firstdate->format('y-m-d'));
        $reserve->setLastdate($lastdate->format('y-m-d'));
        $reserve->setAmount($this->totalAmount($daterange, $userid));

        $this->reserveDAO->Add($reserve);

        //enviar a vista perfil
        $this->UserController->ShowProfileView();
    }


    public function totalAmount($daterange, $userid)
    {
        //se cuentan cuantos dias hay en daterange
        $dateArray = explode(",", $daterange);
        $firstdate = new DateTime($dateArray[0]);
        $lastdate = new DateTime($dateArray[1]);

        $interval = $firstdate->diff($lastdate);
        // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
        // var_dump($interval);

        // $duration = new \DateInterval('P1Y');
        $intervalInSeconds = (new DateTime())->setTimeStamp(0)->add($interval)->getTimeStamp();
        $intervalInDays = $intervalInSeconds / 86400;
        // echo $intervalInDays;

        //obtiene keeper por userid
        $keeper = $this->KeeperController->getByUserId($userid);

        //se le extrae el precio al keeper
        $valorxDia = $keeper->getPricing();

        //se multiplica cant dias * precio keeper
        $total = $valorxDia *  $intervalInDays + $valorxDia;

        //se retorna cantidad total
        return $total;
    }


    public function showAddView($choosePetid = null)  //parametro entra de reserve-add (por si selecciona reservar desde la mascota)
    {
        $listadoMascotas = $this->PetController->GetByUserId($_SESSION['userid']);
        $choosePet = $this->PetController->PetFinder($choosePetid);
        require_once(VIEWS_PATH . "reserve-add.php");
    }


    public function showChooseKeeperView($petid, $daterange)
    {
        $pet = $this->PetController->PetFinder($petid);

        $breed = $pet->getBreedId();

        //parseo atributos
        $dateArray = explode(",", $daterange);
        $dateStart = new DateTime($dateArray[0]);
        $dateFinish = new DateTime($dateArray[1]);
        $dateStart2 = new DateTime($dateArray[0]);
        $dateFinish2 = new DateTime($dateArray[1]);

        //obtenemos ids de los "disponibles" (aquellos que tienen al menos una fecha en el rango del dueño)
        $AvailableDates = $this->AvailableDateController->getAvailablesListByDatesAndBreed($breed, $dateStart->format('y-m-d'), $dateFinish->format('y-m-d'));
        $pseudoAvailableUsers = array();
        $flag = 0;
        if ($AvailableDates != null) {
            foreach ($AvailableDates as $user) {
                $flag = 0;
                foreach ($pseudoAvailableUsers as $user2) {
                    if ($user->getUserid() == $user2->getUserid()) {
                        $flag = 1;
                    }
                }
                if ($flag == 0) {
                    array_push($pseudoAvailableUsers, $this->UserController->GetUserById($user->getUserid()));
                }
            }
        }

        //obtenemos todos los dias marcados por el dueño
        $availables = array();
        while ($dateStart <= $dateFinish) {
            $date1 = new DateTime();
            $date1 = $dateStart;
            $date2 = $date1->format('Y-m-d');
            array_push($availables, $date2);
            $dateStart->modify('+1 day');
        }

        //se guardan los users
        $AvailableUsers = array();
        $AvailableKeepers = array();
        foreach ($pseudoAvailableUsers as $user) {
            $flag = 0;
            foreach ($availables as $date) {

                if (!($this->AvailableDateController->CheckDate($user->getUserid(), $date))) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                array_push($AvailableUsers, $user);

                //se guardan los keepers (que son el mismo usuario)
                $keeper = $this->KeeperController->getByUserId($user->getUserid());
                array_push($AvailableKeepers, $keeper);
            }
        }
        require_once(VIEWS_PATH . "choose-keeper.php");
    }

    // public function checkOverlap($petid, $userid, $dateStart, $dateFinish){
    //     return $this->reserveDAO->getDuplicate($petid, $userid, $dateStart, $dateFinish);
    // }
    public function payReserve($reserveid){
        //se lo manda a la vista de pago
        //se "paga"
        //se envia el cupon de pago por mail
        //chequeamos que ambos pagos esten hechos (getThePayments)
        //si ambos estan se hace un status update a "payed"
    }


    
    // It updates the status on 'Reserve' table by userid
    public function StatusUpdate($reserveid, $status){
        $reserve = new Reserve();
        $reserve->setReserveid($reserveid);
        $reserve->setStatus($status);

        $reserveDAO = new ReserveDAO();
        $reserveDAO->StatusUpdate($reserve);

        // After update returns to UserProfile
//        header('Location:../User/ShowProfileView');
        $this->UserController->ShowProfileView();
    }

    public function RejectReserve($reserveid){
        $this->StatusUpdate($reserveid, "rejected");
    }

    public function CancelReserve($reserveid){
        $this->StatusUpdate($reserveid, "canceled");
    }

    public function AcceptReserve($reserveid){
        $currentReserve = $this->reserveDAO->getReserveById($reserveid);
        $currentPet = $this->PetController->PetFinder($currentReserve->getPetid());
        $reserveList = $this->reserveDAO->getKeeperReserves($currentReserve->getReceiverid());
        foreach($reserveList as $reserve){
            if($currentReserve->getFirstdate() >= $reserve->getFirstdate() && $currentReserve->getLastDate() <= $reserve->getLastdate()){
                $pet = $this->PetController->PetFinder($reserve->getPetid());
                if($pet->getBreedid() == $currentPet->getBreedid()){
                    $this->StatusUpdate($reserveid, "confirmed");
                }else{
                    $this->StatusUpdate($reserveid, "rejected");
                }
            }
        }
    }

}
