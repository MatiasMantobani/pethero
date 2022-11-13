<?php

namespace Controllers;

use \Exception as Exception;
use Controllers\AuthController as AuthController;
use DAO\ReserveDAO;
use Models\Payment;
use Models\Reserve as Reserve;
use DateInterval;
use DateTime;
use Cassandra\Date;
use Controllers\AvailableDateController as AvailableDateController;
use Models\AvailableDate;
use Controllers\UserController as UserController;
use Controllers\KeeperController as KeeperController;
use Controllers\PetController as PetController;
use Controllers\PaymentController as PaymentController;

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


    //lo llama el boton de ver historial de reservas
    public function ShowReservesView($pseudostatus)
    {
        // el pseudostatus es para no mostrar los estados de la BD en el front

        $reserveList = array();

        //trear todas las reservas por usuario logueado
        if ($_SESSION["type"] == "D") {
            $reserves = $this->reserveDAO->getOwnerReserves($_SESSION['userid']);
        } else if ($_SESSION["type"] == "G") {
            $reserves = $this->reserveDAO->getKeeperReserves($_SESSION['userid']);
        }

        $status = "";
        if ($pseudostatus == "Todas") {
            $reserveList = $reserves;
        } else {
            if ($pseudostatus == "Completadas") {
                $status = "completed";
            } else if ($pseudostatus == "En Espera") {
                $status = "await";
            } else if ($pseudostatus == "Confirmadas") {
                $status = "confirmed";
            } else if ($pseudostatus == "Rechazadas") {
                $status = "rejected";
            } else if ($pseudostatus == "Pagadas") {
                $status = "payed";
            } else if ($pseudostatus == "En Progreso") {
                $status = "in progress";
            } else if ($pseudostatus == "Completadas") {
                $status = "completed";
            } else if ($pseudostatus == "Calificadas") {
                $status = "completed & reviewed";
            } else if ($pseudostatus == "Canceladas") {
                $status = "canceled";
            }

            //pasamos las reservas con el status pedidos a la vista
            foreach ($reserves as $reserve) {
                if ($reserve->getStatus() == $status) {
                    array_push($reserveList, $reserve);
                }
            }
        }

        $petInfo = $this->PetController;
        $keeperInfo = $this->UserController;

        //para evitar mostrar una lista vacia
        if (count($reserveList) > 0) {
            require_once(VIEWS_PATH . "reserve-list.php");
        } else {
            $_SESSION["message"] = "No tienes reservas para mostrar";
            $userController = new UserController();
            $userController->ShowProfileView();
        }
    }

    public function ShowAllReservesView()
    {
        // el pseudostatus es para no mostrar los estados de la BD en el front

        $reserveList = array();

        //trear todas las reservas por usuario logueado
        if ($_SESSION["type"] == "D") {
            $reserves = $this->reserveDAO->getOwnerReserves($_SESSION['userid']);
        } else if ($_SESSION["type"] == "G") {
            $reserves = $this->reserveDAO->getKeeperReserves($_SESSION['userid']);
        }

        $reserveList = $reserves;
        $pseudostatus = "Todas";

        $petInfo = $this->PetController;
        $keeperInfo = $this->UserController;

        //para evitar mostrar una lista vacia
        if (count($reserveList) > 0) {
            require_once(VIEWS_PATH . "reserve-list.php");
        } else {
            $_SESSION["message"] = "No tienes reservas para mostrar";
            $userController = new UserController();
            $userController->ShowProfileView();
        }
    }

    //lo llama el boton de pagar reserva del user-profile
    public function PayReserve($reserveid)
    {
        //conseguimos la mitad del total de la reserva para mandarselo a cada pago
        // $paymentController = new PaymentController;
        // $mitadDelTotal = $this->reserveDAO->getReserveById($reserveid)->getAmount() / 2;

        //chequeamos que ambos pagos esten hechos
        $this->StatusUpdate($reserveid, "payed");

        $paymentController = new PaymentController();
        $payment = $paymentController->GetFirstPayment($reserveid);
        $paymentController->UpdatePayment($payment->getPaymentid());

        $_SESSION['message'] = "Tu Cupon de Pagado se ha acreditado correctamente! ";
        $this->UserController->ShowProfileView();
    }


    public function getMyReserves()
    {
        if ($_SESSION["type"] == "D") {
            return $this->reserveDAO->getOwnerReserves($_SESSION['userid']);
        } else if ($_SESSION["type"] == "G") {
            return $this->reserveDAO->getKeeperReserves($_SESSION['userid']);
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
        $_SESSION['message'] = "Reserva realizada con exito ";
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
                if ($user->getStatus() == 1) {
                    array_push($AvailableUsers, $user);
                }

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

    // It updates the status on 'Reserve' table by userid
    public function StatusUpdate($reserveid, $status)
    {
        $reserve = new Reserve();
        $reserve->setReserveid($reserveid);
        $reserve->setStatus($status);

        $reserveDAO = new ReserveDAO();
        $reserveDAO->StatusUpdate($reserve);

        // After update returns to UserProfile
        //        header('Location:../User/ShowProfileView');

    }

    public function RejectReserve($reserveid)
    {
        $this->StatusUpdate($reserveid, "rejected");
        $_SESSION['message'] = "Reserva rechazada";
        $this->UserController->ShowProfileView();
    }

    public function CancelReserve($reserveid)
    {
        $this->StatusUpdate($reserveid, "canceled");
        $_SESSION['message'] = "Reserva cancelada";
        $this->UserController->ShowProfileView();
    }

    public function CheckInPet($reserveid)
    {
        $this->StatusUpdate($reserveid, "in progress");
        $_SESSION['message'] = "Mascota ingresada";
        $this->UserController->ShowProfileView();
    }

    public function PickUpPet($reserveid)
    {
        $this->StatusUpdate($reserveid, "completed");
        $_SESSION['message'] = "Mascota retirada";
        $this->UserController->ShowProfileView();
    }

    public function Reviewed($reserveid)
    {
        $this->StatusUpdate($reserveid, "completed & reviewed");
        $this->UserController->ShowProfileView();
    }

    public function AcceptReserve($reserveid)
    {
        $currentReserve = $this->reserveDAO->getReserveById($reserveid);                       //seleccionas la reserva actual
        $currentPet = $this->PetController->PetFinder($currentReserve->getPetid());             //seleccionas la mascota actual
        $reserveList = $this->reserveDAO->getKeeperReserves($currentReserve->getReceiverid());  //seleccionas todas las reservas del keeper
        $resultado = "confirmed";

        foreach ($reserveList as $reserve) {

            if ($currentReserve->getReserveid() != $reserve->getReserveid()) {                       //si no es la misma reserva
                if ($reserve->getStatus() == "confirmed" || $reserve->getStatus() == "payed" || $reserve->getStatus() == "in progress") {    //si los estados de las reservas son compatibles (ej: no tiene sentido chequear contra una reserva cancelada)
                    if ($currentReserve->getFirstdate() >= $reserve->getFirstdate() && $currentReserve->getFirstDate() <= $reserve->getLastdate() || $currentReserve->getLastdate() >= $reserve->getFirstdate() && $currentReserve->getLastDate() <= $reserve->getLastdate()) { //si las fechas de las reservas coinciden o se superponen
                        $pet = $this->PetController->PetFinder($reserve->getPetid());   //comparo con la mascota de las otras reservas
                        if ($currentPet->getBreedid() != $pet->getBreedid()) {
                            $resultado = "rejected";
                        }
                    }
                }
            }
        }
        $this->StatusUpdate($currentReserve->getReserveid(), $resultado);
        $availableDateController = new AvailableDateController;
        $availableDateController->UpdateDatesByBreed($currentReserve->getReceiverid(), $currentReserve->getFirstdate(), $currentReserve->getLastdate(), $currentPet->getBreedid()); //modifico el status de las availables dates del guardian que se acaba de confirmar

        // To be sent:
        $paymentController = new PaymentController;
        $mitadDelTotal = $this->reserveDAO->getReserveById($reserveid)->getAmount() / 2;

        if ($resultado == "confirmed") {
            $paymentController = new PaymentController();
            $paymentController->Add($currentReserve->getTransmitterid(), $currentReserve->getReceiverid(), $currentReserve->getReserveid(), $currentReserve->getAmount());
        } else {
            $_SESSION['message'] = "Error al confirmar la reserva";
        }

        $mail = new MailerController();
        $mail->emailSend($currentReserve->getTransmitterid(), $mitadDelTotal);

        $_SESSION['message'] = "Reserva aceptada";
        $this->UserController->ShowProfileView();
    }

    public function getReserveById($reserveid)
    {
        return $this->reserveDAO->getReserveById($reserveid);
    }
}
