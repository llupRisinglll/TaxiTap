<?php

namespace Chat\Repository;

use Ratchet\ConnectionInterface;

interface ChatRepositoryInterface
{
    public function getClientByName($name);

    public function getClientByConnection(ConnectionInterface $conn);

    public function addClient(ConnectionInterface $conn);

    public function removeClient(ConnectionInterface $conn);

    public function getClients();
}
