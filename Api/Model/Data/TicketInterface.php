<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Api\Model\Data;

/**
 * Interface TicketInterface
 * @package ALevel\Support\Api\Model\Data
 */
interface TicketInterface
{
    /**
     * @return int|null
     */
    public function getId() : ?int;

    /**
     * @param string $firstName
     * @return TicketInterface
     */
    public function setFirstName(string $firstName) : TicketInterface;

    /**
     * @return string
     */
    public function getFirstName() : string;

    /**
     * @param string $lastName
     * @return TicketInterface
     */
    public function setLastName(string $lastName) : TicketInterface;

    /**
     * @return string
     */
    public function getLastName() : string;

    /**
     * @param string $message
     * @return TicketInterface
     */
    public function setMessage(string $message) : TicketInterface;

    /**
     * @return string
     */
    public function getMessage() : string;

    /**
     * @param StatusInterface $status
     * @return TicketInterface
     */
    public function setStatus(StatusInterface $status) : TicketInterface;

    /**
     * @return StatusInterface
     */
    public function getStatus() : StatusInterface;

    /**
     * @return string
     */
    public function getCreatedAt() : string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;
}
