<?php

namespace DAO;

use \Exception as Exception;
use Models\Adress as Adress;
use Models\User as User;
use DAO\Connection as Connection;

class AdressDAO
{
    private $connection;
    private $tableUsers = "users";
    private $tableAdresses = "adresses";

    public function Add(Adress $adress)
    {
        try {
            $query = "INSERT INTO " . $this->tableAdresses . " (userid, street, number, floor, department, postalcode) VALUES (:userid, :street, :number, :floor, :department, :postalcode);";

            $parameters["userid"] = $adress->getUserid();
            $parameters["street"] = $adress->getStreet();
            $parameters["number"] = $adress->getNumber();
            $parameters["floor"] = $adress->getFloor();
            $parameters["department"] = $adress->getDepartment();
            $parameters["postalcode"] = $adress->getPostalcode();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Update($userid, $street, $number, $floor, $department, $postalcode)
    {
        try {
            $query = "CALL adress_update(?,?,?,?,?,?);";

            $parameters["userid"] = $userid;
            $parameters["street"] = $street;
            $parameters["number"] = $number;
            $parameters["floor"] = $floor;
            $parameters["department"] = $department;
            $parameters["postalcode"] = $postalcode;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Remove($userid)
    {

        try {
            $query = "DELETE FROM " . $this->tableAdresses . " WHERE (userid = :userid)";

            $parameters["userid"] =  $userid;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetByUserid($userid)
    {
        try {
            $adress = null;

            $query = "SELECT userid, street, number, floor, department, postalcode FROM " . $this->tableAdresses . " WHERE (userid = :userid)";

            $parameters["userid"] = $userid;

            $this->connection = Connection::GetInstance();

            $results = $this->connection->Execute($query, $parameters);

            foreach ($results as $row) {
                $adress = new Adress();
                $adress->setUserid($row["userid"]);
                $adress->setStreet($row["street"]);
                $adress->setNumber($row["number"]);
                $adress->setFloor($row["floor"]);
                $adress->setDepartment($row["department"]);
                $adress->setPostalcode($row["postalcode"]);
            }
            return $adress;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


}

/*
try{}catch(Exception $ex){throw $ex;}
*/