<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Reserve as Reserve;
use Models\User as User;

class ReserveDAO
{
    private $connection;
    private $tableReserve = "reserve";

    public function getAll()
    {
        try {
            $reserveList = array();

            $query = "SELECT * FROM " . $this->tableReserve;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $reserve = new Reserve();

                $reserve->setReserveid($row["reserveid"]);
                $reserve->setTransmitterid($row["transmitterid"]);
                $reserve->setReceiverid($row["receiverid"]);
                $reserve->setPetid($row["petid"]);
                $reserve->setDate($row["date"]);
                $reserve->setAmount($row["amount"]);
                $reserve->setIsconfirmed($row["isconfirmed"]);
                $reserve->setPaymentid($row["paymentid"]);
                $reserve->setIspayed($row["ispayed"]);
                $reserve->setIscompleted($row["iscompleted"]);

                array_push($reserveList, $reserve);
            }

            return $reserveList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Add(Reserve $reserve)
    {
        try
        {
        $query = "INSERT INTO ".$this->tableReserve." (reserveid, transmitterid, receiverid, petid, date, amount, isconfirmed, paymentid, ispayed, iscompleted) VALUES (:reserveid, :transmitterid, :receiverid, :petid, :date, :amount, :isconfirmed, :paymentid, :ispayed, :iscompleted);";

        $parameters["reserveid"] = $reserve->getReserveid();
        $parameters["transmitterid"] = $reserve->getTransmitterid();
        $parameters["receiverid"] = $reserve->getReceiverid();
        $parameters["petid"] = $reserve->getPetid();
        $parameters["date"] = $reserve->getDate();
        $parameters["amount"] = $reserve->getAmount();
        $parameters["isconfirmed"] = $reserve->getIsconfirmed();
        $parameters["paymentid"] = $reserve->getPaymentid();
        $parameters["ispayed"] = $reserve->getIspayed();
        $parameters["iscompleted"] = $reserve->getIscompleted();

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Remove($reserveid)
    {
        $query = "DELETE FROM ".$this->tableReserve." WHERE (reserveid = :reserveid)";
        $parameters["reserveid"] =  $reserveid;

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
    }
}