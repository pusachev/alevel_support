<?php

namespace ALevel\Support\Api\Model\Data;

interface TicketInterface
{
    /**
     * @return int|null
     */
    public function getId();

    public function setFirstName(string $firstName) : TicketInterface;

    public function getFirstName() : string;

    public function setLastName(string $lastName) : TicketInterface;

    public function getLastName() : string;

    public function setMessage(string $message) : TicketInterface;

    public function getMessage() : string;

    public function setStatus(StatusInterface $status) : TicketInterface;

    public function getStatus() : StatusInterface;

    public function getCreatedAt() : \DateTimeInterface;

    public function getUpdatedAt(): \DateTimeInterface;
}