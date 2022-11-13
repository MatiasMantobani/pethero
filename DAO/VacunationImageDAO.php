<?php

namespace DAO;

use \Exception as Exception;
use DAO\QueryType as QueryType;
use Models\VacunationImage as VacunationImage;

class VacunationImageDao
{
    private $tableName = "vacunation_images";


    public function Add(VacunationImage $image)
    {
        try {
            $query = "CALL vacunation_images_add(?,?);";

            $parameters["name"] = $image->getName();
            $parameters["petid"] = $image->getPetid();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Update(VacunationImage $image)
    {
        try {
            $query = "CALL vacunation_images_update(?,?);";

            $parameters["name"] = $image->getName();
            $parameters["petid"] = $image->getPetid();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    function GetByPetId($petid)
    {
        try {
            $image = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE petid = :petid";

            $parameters["petid"] = $petid;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $image = new VacunationImage();
                $image->setImageid($row["imageid"]);
                $image->setName($row["name"]);
                $image->setPetid($row["petid"]);
            }

            return $image;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Remove($imageid)
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE (imageid = :imageid)";
        $parameters["imageid"] =  $imageid;

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
    }
}
