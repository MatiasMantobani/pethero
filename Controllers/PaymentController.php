<?php

namespace Controllers;

use Models\Payment as Payment;
use DAO\PaymentDAO as paymentDAO;

class PaymentController
{
    private $paymentDAO;

    public function __construct()
    {
        $this->paymentDAO = new PaymentDAO();
    }

    public function Add($transmitterid, $receiverid, $reserveid, $amount)
    {
        $payment = new Payment();
        $payment->setTransmitterid($transmitterid);
        $payment->setReceiverid($receiverid);
        $payment->setReserveid($reserveid);
        $payment->setMonto($amount);
        $payment->setQr("qr.png");

        $this->paymentDAO->Add($payment);
    }

    public function GetAllByUserId($userid)
    {
        return $this->paymentDAO->GetAllByUserId($userid);
    }

    //retona entre 0 y 2 pagos
    public function GetByReserveId($reserveid)
    {
        return $this->paymentDAO->GetByReserveId($reserveid);
    }

    public function GetFirstPayment($reserveid){
        $payments = $this->GetByReserveId($reserveid);
        $firstPayment = $payments[0];
        foreach ($payments as $payment){
            if($payment->getPaymentid() < $firstPayment->getPaymentid()){
                $firstPayment = $payment;
            }
        }
        return $firstPayment;
    }

    public function UpdatePayment($paymentid)
    {
        $this->paymentDAO->UpdatePayment($paymentid);
    }

    public function getMyPayments()
    {
        if ($_SESSION["type"] == "D") {
            return $this->paymentDAO->GetOwnerPayments($_SESSION['userid']);
        } else if ($_SESSION["type"] == "G") {
            return $this->paymentDAO->GetKeeperPayments($_SESSION['userid']);
        }
    }



}
