<?php

namespace DAO;

use \Exception as Exception;
use Models\AvailableDate as AvailableDate;
use DAO\Connection as Connection;

class AvailableDateDAO
{
    private $connection;
    private $tableAvailableDates = "availabledates";



    public function Add(AvailableDate $availableDate)
    {
        try {
            $query = "INSERT INTO " . $this->tableAvailableDates . "(userid, date, available) VALUES (:userid, :date, :available);";
            $parameters["userid"] = $availableDate->getUserid();
            $parameters["date"] = $availableDate->getDate();
            $parameters["available"] = $availableDate->getAvailable();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetByUserid($userid)
    {
        try {
            $dateList = array();
            $query = "SELECT * FROM " . $this->tableAvailableDates . " WHERE (userid = :userid)";
            $parameters["userid"] = $userid;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            foreach ($resultSet as $row) {

                $date = new AvailableDate();
                $date->setAvailableDateId($row["availabledatesid"]);
                $date->setUserid($row["userid"]);
                $date->setDate($row["date"]);
                $date->setAvailable($row["available"]);

                //


                array_push($dateList, $date);
            }
            return $dateList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    //chequear si fecha existe
    public function CheckDate($userid, $date)
    {
        $query = "SELECT date FROM " . $this->tableAvailableDates . " WHERE (userid = :userid AND date = :date)";
        $parameters["userid"] = $userid;
        $parameters["date"] = $date;
        $this->connection = Connection::GetInstance();
        $resultado = $this->connection->Execute($query, $parameters);
        if ($resultado) {
            return true;
        }
        return false;
    }

    //borra todas las reservas
    public function Remove($userid)
    {
        $query = "DELETE FROM " . $this->tableAvailableDates . " WHERE (userid = :userid)";

        $parameters["userid"] =  $userid;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
    }

    //borra por "userid" y "available == 0"
    public function RemoveAvailablesById($userid)
    {
        $query = "DELETE FROM " . $this->tableAvailableDates . " WHERE (userid = :userid AND available = :available)";

        $parameters["userid"] =  $userid;
        $parameters["available"] =  "0";

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
    }

    public function GetAvailablesByRangeAndBreed($dateStart, $dateFinish, $breed)
    {
        $query = "SELECT * FROM " . $this->tableAvailableDates . " WHERE ((date >= :date1 AND date <= :date2) AND (available = :available1 OR available = :available2))";

        $parameters["date1"] =$dateStart;
        $parameters["date2"] =$dateFinish;
        $parameters["available1"] = $breed;
        $parameters["available2"] = "0";

        $resultado = array();
//        $resultSet = array();

        $this->connection = Connection::GetInstance();        
        $resultSet = $this->connection->Execute($query, $parameters);
       
        //echo "RESULTSET <br>";
        //var_dump($resultSet);
       
        foreach ($resultSet as $row) {
            
            $date = new AvailableDate();
            $date->setAvailableDateId($row["availabledatesid"]);
            $date->setUserid($row["userid"]);
            $date->setDate($row["date"]);
            $date->setAvailable($row["available"]);
           
           

            array_push($resultado, $date);
        }
        print_r($resultado);
        echo "<br>FIN<br>";
       
        if ($resultado) {
            return $resultado;
        } else
        {
            return null;
        }
        
    }

    // Necesitamos función que devuelva Fechas posibles para los dueños
    // Seleccionar por fecha específica aquellos keepers que cuiden perros de la misma raza O que cuiden cualquier perro y que cuiden perros del tamaño buscado 
    // "SELECT userid FROM".$this->tableAvailableDates."WHERE

    // ver si guardian tiene alguna fecha disponible en rango de seleccion de dueño
    // tamaño de guardian == tamaño de perro || available == 0 || available == breedid de perro que realiza reserva

    //DUEÑO
    //selecciona rango de fechas
    //selecciona perro -> recuperas breeid

    //TABLA DE DISPONIBILIDAD
    //chequear todas las fechas de todos los guardianes -> devolver los userid con las fechas disponible
    //chequiemos dates por user id


    

}
