<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Reserve as Reserve;
use \Exception as Exception;

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
                $reserve->setFirstdate($row["firstdate"]);
                $reserve->setLastdate($row["lastdate"]);
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
        $query = "INSERT INTO ".$this->tableReserve." (transmitterid, receiverid, petid, firstdate, lastdate, amount) VALUES (:transmitterid, :receiverid, :petid, :firstdate, :lastdate :amount);";

        $parameters["transmitterid"] = $reserve->getTransmitterid();
        $parameters["receiverid"] = $reserve->getReceiverid();
        $parameters["petid"] = $reserve->getPetid();
        $parameters["firstdate"] = $reserve->getFirstdate();
        $parameters["lastdate"] = $reserve->getLastdate();
        $parameters["amount"] = $reserve->getAmount();

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