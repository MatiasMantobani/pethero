<?php

namespace DAO;

use \Exception as Exception;
use Models\Review as Review;
use DAO\Connection as Connection; 

class ReviewDAO
{
    private $connection;
    private $tableReviews = "review";

    public function Add(Review $review)
    {
        try
        {
            $query  = "INSERT INTO " . $this->tableReviews . " (emitterid, receptorid, reserveid, rating, comment) VALUES (:emitterid, :receptorid, :reserveid, :rating, :comment);";
            $parameters["emitterid"] = $review->getEmitterid();
            $parameters["receptorid"] = $review->getReceptorid();
            $parameters["reserveid"] = $review->getReserveid();
            $parameters["rating"] = $review->getRating();
            $parameters["comment"] = $review->getComment(); 
        
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    public function GetByEmitterid($emitterid) // untested - 05/11/2022 - Juan
    {
        try
        {
        $reviewList = array();

        $query = "SELECT * FROM ". $this->tableReviews . " WHERE (emitterid = :emitterid) ORDER BY reserveid";
    
        $parameters["emitterid"] = $emitterid;

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query, $parameters);

        foreach ($resultSet as $row)
        {
            $review = new Review();

            $review->setReviewid($row["reviewid"]);
            $review->setEmitterid($row["emitterid"]);
            $review->setReceptorid($row["receptorid"]);
            $review->setReserveid($row["reserveid"]);
            $review->setRating($row["rating"]);
            $review->setComment($row["comment"]);
            
            array_push($reviewList, $review);

        }
        return $reviewList;
        
    } catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function GetByReceptorid($receptorid) // untested - 05/11/2022 - Juan
    {
        try
        {
        $reviewList = array();

        $query = "SELECT * FROM ". $this->tableReviews . " WHERE (receptorid = :receptorid) ORDER BY reserveid";
    
        $parameters["receptorid"] = $receptorid;

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query, $parameters);

        foreach ($resultSet as $row)
        {
            $review = new Review();

            $review->setReviewid($row["reviewid"]);
            $review->setEmitterid($row["emitterid"]);
            $review->setReceptorid($row["receptorid"]);
            $review->setReserveid($row["reserveid"]);
            $review->setRating($row["rating"]);
            $review->setComment($row["comment"]);
            
            array_push($reviewList, $review);

        }
        return $reviewList;
        
    } catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function GetByReserveid($reserveid) //debe retornar uno      // untested - 05/11/2022 - Juan
    {
        try
        {
        $reviewList = array();

        $query = "SELECT * FROM ". $this->tableReviews . " WHERE (reserveid = :reserveid)";
    
        $parameters["reserveid"] = $reserveid;

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query, $parameters);

        foreach ($resultSet as $row)
        {
            $review = new Review();

            $review->setReviewid($row["reviewid"]);
            $review->setEmitterid($row["emitterid"]);
            $review->setReceptorid($row["receptorid"]);
            $review->setReserveid($row["reserveid"]);
            $review->setRating($row["rating"]);
            $review->setComment($row["comment"]);
            
            array_push($reviewList, $review);

        }
        return $reviewList;
        
    } catch(Exception $ex)
        {
            throw $ex;
        }

    }
}
?>