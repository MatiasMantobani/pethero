<?php

namespace DAO;

use DAO\QueryType as QueryType;
use \Exception as Exception;
use Models\Keeper as Keeper;
use DAO\Connection as Connection;

class KeeperDAO
{
    private $connection;
    private $tableUsers = "keepers";


    public function Add(Keeper $keeper)
    {
        try {
            $query = "INSERT INTO " . $this->tableUsers . " (userid) VALUES (:userid);";

            $parameters["userid"] = $keeper->getUserid();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $keeperList = array();

            $query = "SELECT * FROM " . $this->tableUsers;
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $keeper = new Keeper();

                $keeper->setKeeperid($row["keeperid"]);
                $keeper->setUserid($row["userid"]);
                $keeper->setRating($row["rating"]);
                $keeper->setPricing($row["pricing"]);
                $keeper->setStatus($row["status"]);

                array_push($keeperList, $keeper);
            }

            return $keeperList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByKeeperId($keeperid)
    {
        $keeper = null;

        $query = "SELECT keeperid, userid, rating, pricing, status FROM " . $this->tableUsers . " WHERE (keeperid = :keeperid)";

        $parameters["keeperid"] = $keeperid;

        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query, $parameters);

        foreach ($results as $row) {
            $keeper = new Keeper();
            $keeper->setKeeperid($row["keeperid"]);
            $keeper->setUserid($row["userid"]);
            $keeper->setRating($row["rating"]);
            $keeper->setPricing($row["pricing"]);
            $keeper->setStatus($row["status"]);

        }
        return $keeper;
    }

    public function GetByUserId($userid)
    {
        $keeper = null;

        $query = "SELECT keeperid, userid, rating, pricing, status FROM " . $this->tableUsers . " WHERE (userid = :userid)";

        $parameters["userid"] = $userid;

        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query, $parameters);

        foreach ($results as $row) {
            $keeper = new Keeper();
            $keeper->setKeeperid($row["keeperid"]);
            $keeper->setUserid($row["userid"]);
            $keeper->setRating($row["rating"]);
            $keeper->setPricing($row["pricing"]);
            $keeper->setStatus($row["status"]);
        }
        return $keeper;
    }

    public function UpdatePricing(Keeper $keeper)
    {
        try
        {
            $query = "CALL keeper_pricing_update(?,?);";

            $parameters["userid"] = $keeper->getUserid();
            $parameters["pricing"] = $keeper->getPricing();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function UpdateStatus(Keeper $keeper)
    {
        try
        {
            $query = "CALL keeper_status_update(?,?);";

            $parameters["userid"] = $keeper->getUserid();
            $parameters["status"] = $keeper->getStatus();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

}