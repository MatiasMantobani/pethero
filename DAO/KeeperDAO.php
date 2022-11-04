<?php

namespace DAO;

use \Exception as Exception;
use Models\Keeper as Keeper;
use DAO\Connection as Connection;

class KeeperDAO
{
    private $connection;
    private $tableKeepers = "keepers";

    public function Add(Keeper $keeper)
    {
        try {
            $query = "INSERT INTO " . $this->tableKeepers . "(keeperid, pricing, rating, userid) VALUES (:keeperid, :pricing, :rating, :userid);";

            $parameters["keeperid"] = $keeper->getKeeperid();
            $parameters["pricing"] = $keeper->getPricing();
            $parameters["rating"] = $keeper->getRating();
            $parameters["userid"] = $keeper->getUserid();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function UpdatePricing($pricing, $userid)
    {
        $query = "UPDATE " . $this->tableKeepers . " (pricing = :pricing) WHERE (userid = :userid)";

        $parameters["pricing"] =  $pricing;
        $parameters["userid"] =  $userid;

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
    }
    public function UpdateRating($rating, $userid)
    {
    }
    public function GetByUserid($userid)
    {
        $keeper = null;

        $query = "SELECT * FROM " . $this->tableKeepers . " WHERE (userid = :userid)";

        $parameters["userid"] = $userid;

        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query, $parameters);
        // var_dump($results);
        if ($results) {

            $keeper = new Keeper();
            $keeper->setKeeperid($results[0]["keeperid"]);
            $keeper->setUserid($results[0]["userid"]);
            $keeper->setRating($results[0]["rating"]);
            $keeper->setPricing($results[0]["pricing"]);
        }
        return $keeper;
    }
}
