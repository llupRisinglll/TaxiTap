<?php

namespace Chat\Connection;

interface ChatConnectionInterface
{
    public function getConnection();

    public function getName();

    public function setName($name);

    public function shareLocation($sender, $location, $accountType);

    public function transaction($sender, $target, $destination, $passengerNumber);

    public function transactionReply($sender, $username, $status);

}
