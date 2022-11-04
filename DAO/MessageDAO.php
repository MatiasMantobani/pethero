<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Message as Message;

class MessageDAO
{
    private $connection;
    private $tableMessage = "message";

    public function getAll()
    {
        try {
            $messageList = array();

            $query = "SELECT * FROM " . $this->tableMessage;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $message = new Message();

                $message->setText($row["text"]);
                $message->setRead($row["read"]);
                $message->setReceiverid($row["time"]);
                $message->setSender($row["sender"]);

                array_push($messageList, $message);
            }

            return $messageList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Add(Message $message)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableMessage." (text, read, time, sender) VALUES (:text, :read, :time, :sender);";

            $parameters["text"] = $message->getText();
            $parameters["read"] = $message->getRead();
            $parameters["time"] = $message->getTime();
            $parameters["sender"] = $message->getSender();


            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}