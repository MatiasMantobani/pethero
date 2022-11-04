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

                $message->setIdmessage($row["idmessage"]);
                $message->setChatidentifier($row["chatidentifier"]);
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
            $query = "INSERT INTO ".$this->tableMessage." (chatidentifier, text, sender) VALUES (:chatidentifier, :text, :sender);"; // no hace falta agregar ni time ni read porque se setean automaticamente en la bd?

            $parameters["chatidentifier"] = $message->getChatidentifier();
            $parameters["text"] = $message->getText();
            //$parameters["read"] = $message->getRead();
            //$parameters["time"] = $message->getTime();
            $parameters["sender"] = $message->getSender();


            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function markAsRead()
    {
        try
        {
            $query = "INSERT INTO ".$this->tableMessage." (read) VALUES (1);"; // es valido esto para modificar el atributo read de la tabla message?

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters); // problema con $parameters, puede no llevar?

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}