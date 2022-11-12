<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Chat as Chat;

class ChatDAO
{
    private $connection;
    private $tableChat = "chat";

    public function Add(Chat $chat)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableChat." (receiverid, text, senderid) VALUES (:receiverid, :text, :senderid);";

            $parameters["receiverid"] = $chat->getReceiverid();
            $parameters["text"] = $chat->getText();
            $parameters["senderid"] = $chat->getSenderid();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function changeStatus($idmessage, $status)
    {
        try
        {
            $query = "CALL chat_update_status (?,?);";

            $parameters["idmessage"] = $idmessage;
            $parameters["status"] = $status;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function findChat($receiverid, $senderid){
        try{
            $chatList = array();
            $query = "SELECT * FROM ".$this->tableChat ." WHERE (receiverid = :receiverid AND senderid = :senderid OR senderid = :receiverid AND receiverid = :senderid)";

            $parameters["receiverid"] = $receiverid;
            $parameters["senderid"] = $senderid;

            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters);

            foreach($results as $row)
            {
                $chat = new Chat();

                $chat->setIdmessage($row["idmessage"]);
                $chat->setReceiverid($row["receiverid"]);
                $chat->setText($row["text"]);
                $chat->setStatus($row["status"]);
                $chat->setTime($row["time"]);
                $chat->setSenderid($row["senderid"]);

                array_push($chatList, $chat);
            }
            return $chatList;
        }catch(Exception $ex) {
            throw $ex;
        }
    }
}