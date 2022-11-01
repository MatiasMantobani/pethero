<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Keeper as Keeper;
    use DAO\Connection as Connection;
    use Models\Size as Size;

    class SizeDAO
    {
        private $connection;
        private $tableSizes = "sizes";

        public function Add(Size $size)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableSizes." (userid, small, medium, large) VALUES (:userid, :small, :medium, :large);";

                $parameters["userid"] = $size->getUserid();
                $parameters["small"] = $size->getSmall();
                $parameters["medium"] = $size->getMedium();
                $parameters["large"] = $size->getLarge();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove($userid)
        {
            $query = "DELETE FROM ".$this->tableSizes." WHERE (userid = :userid)";

            $parameters["userid"] =  $userid;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }

        public function GetByUserid($userid)
        {
            $size = null;

            $query = "SELECT userid, small, medium, large FROM ".$this->tableSizes." WHERE (userid = :userid)";

            $parameters["userid"] = $userid;

            $this->connection = Connection::GetInstance();

            $results = $this->connection->Execute($query, $parameters);

            foreach($results as $row)
            {
                $size = new Size();
                $size->setUserid($row["userid"]);
                $size->setSmall($row["small"]);
                $size->setMedium($row["medium"]);
                $size->setLarge($row["large"]);
            }
            return $size;
        }




    }
?>