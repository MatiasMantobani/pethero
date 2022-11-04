<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Chat as Chat;

class ChatDAO
{
    private $connection;
    private $tableChat = "chat";

    public function getAll()
    {
        try {
            $chatList = array();

            $query = "SELECT * FROM " . $this->tableChat;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $chat = new Chat();

                $chat->setSender($row["sender"]);
                $chat->setReceiver($row["receiver"]);
                $chat->setMessages($row["messages"]);

                array_push($chatList, $chat);
            }

            return $chatList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Add(Chat $chat)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableChat." (sender, receiver, messages) VALUES (:sender, :receiver, :messages);";

            $parameters["sender"] = $chat->getSender();
            $parameters["receiver"] = $chat->getReceiver();
            $parameters["messages"] = $chat->getMessages();


            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}