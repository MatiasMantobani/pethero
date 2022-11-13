<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;

use Models\Payment as Payment;

class PaymentDAO
{
    private $connection;
    private $tablePayments = "payments";


    //retona entre 0 y 2 pagos
    public function GetByReserveId($reserveid)
    {
        try {
            $paymentList = array();

            $query = "SELECT * FROM " . $this->tablePayments . " WHERE (reserveid = :reserveid)";

            $parameters["reserveid"] = $reserveid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();

                $payment->setPaymentid($row["paymentid"]);
                $payment->setTransmitterid($row["transmitterid"]);
                $payment->setReceiverid($row["receiverid"]);
                $payment->setReserveid($row["reserveid"]);
                $payment->setMonto($row["monto"]);
                $payment->setQr($row["qr"]);
                $payment->setDate($row["date"]);
                $payment->setPayed($row["payed"]);

                array_push($paymentList, $payment);
            }
            return $paymentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function UpdatePayment($paymentid)
    {
        try {
            $query = "CALL payment_update(?);";
            $parameters["paymentid"] = $paymentid;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
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


    public function GetAllByUserIdTransmitter($transmitterid)
    {
        try {
            $paymentList = array();

            $query = "SELECT * FROM " . $this->tablePayments . " WHERE (transmitterid = :transmitterid)";

            $parameters["transmitterid"] = $transmitterid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();

                $payment->setPaymentid($row["paymentid"]);
                $payment->setTransmitterid($row["transmitterid"]);
                $payment->setReceiverid($row["receiverid"]);
                $payment->setReserveid($row["reserveid"]);
                $payment->setMonto($row["monto"]);
                $payment->setQr($row["qr"]);
                $payment->setDate($row["date"]);
                $payment->setPayed($row["payed"]);

                array_push($paymentList, $payment);
            }
            return $paymentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetAllByUserIdReceiver($receiverid)
    {
        try {
            $paymentList = array();

            $query = "SELECT * FROM " . $this->tablePayments . " WHERE (receiverid = :receiverid)";

            $parameters["receiverid"] = $receiverid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();

                $payment->setPaymentid($row["paymentid"]);
                $payment->setTransmitterid($row["transmitterid"]);
                $payment->setReceiverid($row["receiverid"]);
                $payment->setReserveid($row["reserveid"]);
                $payment->setMonto($row["monto"]);
                $payment->setQr($row["qr"]);
                $payment->setDate($row["date"]);
                $payment->setPayed($row["payed"]);

                array_push($paymentList, $payment);
            }
            return $paymentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetOwnerPayments($userid)
    {
        try {
            $paymentList = array();

            $query = "SELECT * FROM " . $this->tablePayments . " WHERE (transmitterid = :transmitterid)";

            $parameters["transmitterid"] = $userid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();

                $payment->setPaymentid($row["paymentid"]);
                $payment->setTransmitterid($row["transmitterid"]);
                $payment->setReceiverid($row["receiverid"]);
                $payment->setReserveid($row["reserveid"]);
                $payment->setMonto($row["monto"]);
                $payment->setQr($row["qr"]);
                $payment->setDate($row["date"]);
                $payment->setPayed($row["payed"]);

                array_push($paymentList, $payment);
            }
            return $paymentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetKeeperPayments($userid)
    {
        try {
            $paymentList = array();

            $query = "SELECT * FROM " . $this->tablePayments . " WHERE (receiverid = :receiverid)";

            $parameters["receiverid"] = $userid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();

                $payment->setPaymentid($row["paymentid"]);
                $payment->setTransmitterid($row["transmitterid"]);
                $payment->setReceiverid($row["receiverid"]);
                $payment->setReserveid($row["reserveid"]);
                $payment->setMonto($row["monto"]);
                $payment->setQr($row["qr"]);
                $payment->setDate($row["date"]);
                $payment->setPayed($row["payed"]);

                array_push($paymentList, $payment);
            }
            return $paymentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
