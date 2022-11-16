<?php

namespace Controllers;

use \Exception as Exception;
use Models\Payment as Payment;
use DAO\PaymentDAO as paymentDAO;

class PaymentController
{
    private $paymentDAO;

    public function __construct()
    {
        $this->paymentDAO = new PaymentDAO();
    }


    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    public function Add($transmitterid, $receiverid, $reserveid, $amount)
    {
        if ($this->validate()) {
            try {
                $payment = new Payment();
                $payment->setTransmitterid($transmitterid);
                $payment->setReceiverid($receiverid);
                $payment->setReserveid($reserveid);
                $payment->setMonto($amount);
                $payment->setQr("qr.png");

                $this->paymentDAO->Add($payment);
            } catch (Exception $ex) {
                HomeController::Index("Error al Agregar Pago");
            }
        }
    }


    public function GetAllByUserIdTransmitter($userid)
    {
        if ($this->validate()) {
            try {
                return $this->paymentDAO->GetAllByUserIdTransmitter($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Pago");
            }
        }
    }


    public function GetAllByUserIdReceiver($userid)
    {
        if ($this->validate()) {
            try {
                return $this->paymentDAO->GetAllByUserIdReceiver($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Pago");
            }
        }
    }


    //retona entre 0 y 2 pagos
    public function GetByReserveId($reserveid)
    {
        if ($this->validate()) {
            try {
                return $this->paymentDAO->GetByReserveId($reserveid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Pago");
            }
        }
    }


    public function GetFirstPayment($reserveid)
    {
        if ($this->validate()) {
            try {
                $payments = $this->GetByReserveId($reserveid);
                $firstPayment = $payments[0];
                foreach ($payments as $payment) {
                    if ($payment->getPaymentid() < $firstPayment->getPaymentid()) {
                        $firstPayment = $payment;
                    }
                }
                return $firstPayment;
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Pago");
            }
        }
    }


    public function UpdatePayment($paymentid)
    {
        if ($this->validate()) {
            try {
                $this->paymentDAO->UpdatePayment($paymentid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Pago");
            }
        }
    }


    public function getMyPayments()
    {
        if ($this->validate()) {
            try {
                if ($_SESSION["type"] == "D") {
                    return $this->paymentDAO->GetOwnerPayments($_SESSION['userid']);
                } else if ($_SESSION["type"] == "G") {
                    return $this->paymentDAO->GetKeeperPayments($_SESSION['userid']);
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Pago");
            }
        }
    }

    public function ShowPaymentList()   // funciona ya sea el transmitter o el receiver
    {

        if ($this->validate()) {
            try {
                $paymentList = $this->GetAllByUserIdTransmitter($_SESSION['userid']);
                if ($paymentList == null) {
                    $paymentList = $this->GetAllByUserIdReceiver($_SESSION['userid']);
                }


                //para evitar mostrar una lista vacia
                if (count($paymentList) > 0) {
                    require_once(VIEWS_PATH . "payment-list.php");
                } else {
                    $_SESSION["message"][] = "No tienes pagos para mostrar";
                    $userController = new UserController();
                    $userController->ShowProfileView();
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Pago");
            }
        }
    }
}


/*
if ($this->validate()) {
try {

} catch (Exception $ex) {
    HomeController::Index("Error al ... Pago");
}
}

*/