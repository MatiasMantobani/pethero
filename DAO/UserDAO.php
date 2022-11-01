<?php

namespace DAO;

use \Exception as Exception;
use Models\User as User;
use DAO\Connection as Connection;

class UserDAO
{
    private $connection;
    private $tableUsers = "users";

    public function Add(User $user)
    {
        try {
            $query = "INSERT INTO " . $this->tableUsers . " (email, password, type, dni, cuit, name, surname, phone) VALUES (:email, :password, :type, :dni, :cuit, :name, :surname, :phone);";

            $parameters["email"] = $user->getEmail();
            $parameters["password"] = $user->getPassword();
            $parameters["type"] = $user->getType();
            $parameters["dni"] = $user->getDni();
            $parameters["cuit"] = $user->getCuit();
            $parameters["name"] = $user->getName();
            $parameters["surname"] = $user->getSurname();
            $parameters["phone"] = $user->getPhone();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $userList = array();

            $query = "SELECT * FROM " . $this->tableUsers;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new User();

                $user->setUserid($row["userid"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setType($row["type"]);
                $user->setDni($row["dni"]);
                $user->setCuit($row["cuit"]);
                $user->setName($row["name"]);
                $user->setSurname($row["surname"]);
                $user->setPhone($row["phone"]);

                array_push($userList, $user);
            }

            return $userList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByEmail($email)
    {
        $user = null;

        $query = "SELECT userid, email, password, name, type, phone FROM " . $this->tableUsers . " WHERE (email = :email)";

        $parameters["email"] = $email;

        $this->connection = Connection::GetInstance();
        $results = $this->connection->Execute($query, $parameters);

        foreach ($results as $row) {
            $user = new User();
            $user->setUserid($row["userid"]);
            $user->setName($row["name"]);
            $user->setType($row["type"]);
            $user->setEmail($row["email"]);
            $user->setPassword($row["password"]);
            $user->setPhone($row["phone"]);
        }

        return $user;
    }

    public function GetById($userid)
    {
        $user = null;

        $query = "SELECT userid, email, password, type, dni, cuit, name, surname, phone FROM " . $this->tableUsers . " WHERE (userid = :userid)";

        $parameters["userid"] = $userid;

        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query, $parameters);

        foreach ($results as $row) {
            $user = new User();
            $user->setUserid($row["userid"]);
            $user->setEmail($row["email"]);
            $user->setPassword($row["password"]);
            $user->setType($row["type"]);
            $user->setDni($row["dni"]);
            $user->setCuit($row["cuit"]);
            $user->setName($row["name"]);
            $user->setSurname($row["surname"]);
            $user->setPhone($row["phone"]);
        }
        return $user;
    }


}

?>