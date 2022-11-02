<?php
namespace DAO;

use DAO\QueryType as QueryType;
use Models\PetImage as PetImage;

class PetImageDao
{
    private $tableName = "pet_images";

    public function Add(PetImage $image)
    {
        try
        {
            $query = "CALL pet_images_add(?,?);";

            $parameters["name"] = $image->getName();
            $parameters["petid"] = $image->getPetid();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Update(PetImage $image)
    {
        try
        {
            $query = "CALL pet_images_update(?,?);";

            $parameters["name"] = $image->getName();
            $parameters["petid"] = $image->getPetid();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    function GetByPetId($petid)
    {
        try
        {
            $image = null;

            $query = "SELECT * FROM ".$this->tableName." WHERE petid = :petid";

            $parameters["petid"] = $petid;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row)
            {
                $image = new PetImage();
                $image->setImageid($row["imageid"]);
                $image->setName($row["name"]);
                $image->setPetid($row["petid"]);
            }

            return $image;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Remove($imageid)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE (imageid = :imageid)";
        $parameters["imageid"] =  $imageid;

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
    }

    
}
?>