<?php

namespace Chat\Connection;

use Chat\Repository\ChatRepositoryInterface;
use Ratchet\ConnectionInterface;


class ChatConnection implements ChatConnectionInterface{

    private $connection;
    private $name;
    private $repository;

    public function __construct(ConnectionInterface $conn, ChatRepositoryInterface $repository, $name = ""){
        $this->connection = $conn;  
        $this->name = $name;
        $this->repository = $repository;
    }

    public function shareLocation($sender, $location, $accountType){
        $this->send([
            'action'   => 'shareLocation',
            'username' => $sender,
            'location' => $location,
            'accountType' => $accountType
        ]);
    }

    public function transaction($sender, $target, $destination, $passengerNumber){
        $this->send([
            'action'   => 'transaction',
            'username' => $sender,
            'target' => $target,
            'destination' => $destination,
            'passengerNumber' => $passengerNumber
        ]);
    }

    public function transactionReply($sender, $username, $status){
        $this->send([
            'action'   => 'transactionReply',
            'username' => $sender,
            'target' => $username,
            'status' => $status
        ]);
    }


    public function getConnection(){
        return $this->connection;
    }


    public function setName($name){
        if ($name === "")
            return;

        // Check if the name exists already
        if ($this->repository->getClientByName($name) !== null) {
            $this->send([
                'action'   => 'setname',
                'success'  => false,
                'username' => $this->name
            ]);
            return;
        }

        // Save the new name
        $this->name = $name;

        $this->send([
            'action'   => 'setname',
            'success'  => true,
            'username' => $this->name
        ]);
        
    }

    public function getName(){ return $this->name; }


    private function send(array $data){
        $this->connection->send(json_encode($data));
    }
}
