<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;

use Models\Payment as Payment;

class PaymentDAO
{
    private $connection;
    private $tablePayments = "payments";


    //get payments by reserveid que retona entre 0 y 2 pagos
    public function GetByReserveId($reserveid){
        try {
            $paymentList = array();

            $query = "SELECT * FROM " . $this->tablePayments . " WHERE (reserveid = :reserveid)";

            $parameters["userid"] = $reserveid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();

                $payment->setTransmitterid($row["transmitterid"]);
                $payment->setReceiverid($row["receiverid"]);
                $payment->setReserveid($row["reserveid"]);
                $payment->setMonto($row["monto"]);
                $payment->setQr($row["qr"]);

                array_push($paymentList, $payment);
            }
            return $paymentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Add(Payment $payment)
    {
        try {
            $query = "INSERT INTO " . $this->tablePayments . " (transmitterid, receiverid, reserveid, monto, qr) VALUES (:transmitterid, :receiverid, :reserveid, :monto, :qr);";

            $parameters["transmitterid"] = $payment->getTransmitterid();
            $parameters["receiverid"] = $payment->getReceiverid();
            $parameters["reserveid"] = $payment->getReserveid();
            $parameters["monto"] = $payment->getMonto();
            $parameters["qr"] = $payment->getQr();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);    //nonquery para sin retorno retorno

        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetAllByUserId($userid)
    {
        try {
            $paymentList = array();

            $query = "SELECT * FROM " . $this->tablePayments . " WHERE (userid = :userid)";

            $parameters["userid"] = $userid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();

                $payment->setTransmitterid($row["transmitterid"]);
                $payment->setReceiverid($row["receiverid"]);
                $payment->setReserveid($row["reserveid"]);
                $payment->setMonto($row["monto"]);
                $payment->setQr($row["qr"]);

                array_push($paymentList, $payment);
            }
            return $paymentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
