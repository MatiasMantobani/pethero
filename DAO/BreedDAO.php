<?php

namespace DAO;

use \Exception as Exception;
use Models\Breed as Breed;
use DAO\Connection as Connection;

class BreedDAO
{
    private $connection;
    private $tableBreed = "breed";

    public function Add(Breed $breed)
    {
        try {
            $query = "INSERT INTO " . $this->tableBreed . " (breedid, name, size, type) VALUES (:breedid, :name, :size, :type);";

            $parameters["breedid"] = $breed->getBreedid();
            $parameters["name"] = $breed->getName();
            $parameters["size"] = $breed->getSize();
            $parameters["type"] = $breed->getType();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Remove($breedid)
    {
        try {
            $query = "DELETE FROM " . $this->tableBreed . " WHERE (breedid = :breedid)";

            $parameters["breedid"] =  $breedid;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $breedList = array();

            $query = "SELECT * FROM " . $this->tableBreed;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $breed = new Breed();

                $breed->setBreedid($row["breedid"]);
                $breed->setName($row["name"]);
                $breed->setSize($row["size"]);
                $breed->setType($row["type"]);

                array_push($breedList, $breed);
            }

            return $breedList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllByType($type)
    {
        try {
            $breedList = array();

            $query = "SELECT * FROM " . $this->tableBreed . " WHERE (type = :type)";
            $parameters["type"] = $type;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $breed = new Breed();

                $breed->setBreedid($row["breedid"]);
                $breed->setName($row["name"]);
                $breed->setSize($row["size"]);
                $breed->setType($row["type"]);

                array_push($breedList, $breed);
            }

            return $breedList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByBreedId($breedid)
    {
        try {
            $breed = null;

            $query = "SELECT breedid, name, size, type FROM " . $this->tableBreed . " WHERE (breedid = :breedid)";

            $parameters["breedid"] = $breedid;

            $this->connection = Connection::GetInstance();

            $results = $this->connection->Execute($query, $parameters);

            foreach ($results as $row) {
                $breed = new Breed();
                $breed->setBreedid($row["breedid"]);
                $breed->setName($row["name"]);
                $breed->setSize($row["size"]);
                $breed->setType($row["type"]);
            }
            return $breed;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
