<?php
namespace DAO;

use DAO\QueryType as QueryType;
use Models\UserImage as UserImage;
use \Exception as Exception;

class UserImageDao 
{
    private $tableName = "user_images";

    public function Add(UserImage $image)
    {
        try
        {
            $query = "CALL images_add(?,?);";

            $parameters["name"] = $image->getName();
            $parameters["userid"] = $image->getUserid();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Update(UserImage $image)
    {
        try
        {
            $query = "CALL images_update(?,?);";

            $parameters["name"] = $image->getName();
            $parameters["userid"] = $image->getUserid();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    function GetByUserId($userid)
    {
        try
        {
            $image = null;

            $query = "SELECT * FROM ".$this->tableName." WHERE userid = :userid";

            $parameters["userid"] = $userid;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row)
            {
                $image = new UserImage();
                $image->setImageid($row["imageid"]);
                $image->setName($row["name"]);
                $image->setUserid($row["userid"]);
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