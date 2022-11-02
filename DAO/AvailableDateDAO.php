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

    public function GetAvailablesByRangeAndBreed($breed,$dateStart,$dateFinish)
    {   
        $query = "SELECT sizes.userid, availabledates.date, availabledates.available, availabledates.availabledatesid FROM sizes INNER JOIN availabledates ON sizes.userid = availabledates.userid WHERE (IF((SELECT size FROM breed WHERE breedid = :raza) = 1, small = 1,IF((SELECT size FROM breed WHERE breedid = :raza) = 2, medium = 1, large = 1)) AND (availabledates.date >= :inicio AND availabledates.date <= :fin) AND (availabledates.available = 0 OR availabledates.available = :raza))";

        $parameters["raza"]=$breed;
        $parameters["inicio"] =$dateStart;
        $parameters["fin"] =$dateFinish;
        


        $resultado = array();
        $resultSet = array();

        $this->connection = Connection::GetInstance(); 

        $resultSet = $this->connection->Execute($query, $parameters);
       
       
        foreach ($resultSet as $row) {
            
            $date = new AvailableDate();
            $date->setAvailableDateId($row["availabledatesid"]);
            $date->setUserid($row["userid"]);
            $date->setDate($row["date"]);
            $date->setAvailable($row["available"]);
          

            array_push($resultado, $date);
        }
        
       
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
