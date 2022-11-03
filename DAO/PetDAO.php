<?php
namespace DAO;

use \Exception as Exception;
use Models\Pet as Pet;
use DAO\Connection as Connection;

class PetDAO
{
    private $connection;
    private $tablePets = "pet";


    public function Add(Pet $pet)
    {
        try
        {
            $query = "INSERT INTO ".$this->tablePets." (userid, breedid, name, observations) VALUES (:userid, :breedid, :name, :observations);";

            $parameters["userid"] = $pet->getUserid();
            $parameters["breedid"] = $pet->getBreedid();
            $parameters["name"] = $pet->getName();
            $parameters["observations"] = $pet->getObservations();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Update(Pet $pet)
    {
        try
        {
            $query = "CALL pet_update(?,?,?);";

            $parameters["petid"] = $pet->getPetid();
            $parameters["name"] = $pet->getName();
            $parameters["observations"] = $pet->getObservations();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Remove($petid)
    {
        try
        {
            $query = "CALL pet_delete(?);";

            $parameters["petid"] = $petid;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetByUserId($userid)
    {
        try
        {
            $petList = array();

            $query = "SELECT petid, status, breedid, name, observations FROM ".$this->tablePets." WHERE (userid = :userid)";

            $parameters["userid"] = $userid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row)
            {
                $pet = new Pet();

                $pet->setPetid($row["petid"]);
                $pet->setStatus($row["status"]);
                $pet->setBreedid($row["breedid"]);
                $pet->setName($row["name"]);
                $pet->setObservations($row["observations"]);

                if ($pet->getStatus() == 1){
                    array_push($petList, $pet);
                }
            }
            return $petList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetByPetId($petid)  //retorna 1 mascota
    {
        $pet = null;

        $query = "SELECT petid, userid, status, breedid, name, observations FROM ".$this->tablePets." WHERE (petid = :petid)";

        $parameters["petid"] = $petid;

        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query, $parameters);

        foreach($results as $row)
        {
            $pet = new Pet();
            $pet->setPetid($row["petid"]);
            $pet->setUserid($row["userid"]);
            $pet->setStatus($row["status"]);
            $pet->setBreedid($row["breedid"]);
            $pet->setName($row["name"]);
            $pet->setObservations($row["observations"]);
        }

        return $pet;
    }

}
?>