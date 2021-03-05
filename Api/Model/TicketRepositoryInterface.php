<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Api\Model;

use ALevel\Support\Api\Model\Data\TicketInterface;
use ALevel\Support\Api\Model\Data\TicketSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface TicketRepositoryInterface
 * @package ALevel\Support\Api\Model
 */
interface TicketRepositoryInterface
{
    /**
     * @param int $id
     * @throw NoSuchEntityException
     * @return TicketInterface
     */
    public function getById(int $id) : TicketInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TicketSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : TicketSearchResultInterface;

    /**
     * @param TicketInterface $ticket
     * @throw CouldNotSaveException
     * @return TicketInterface
     */
    public function save(TicketInterface $ticket) : TicketInterface;

    /**
     * @param TicketInterface $ticket
     * @throw CouldNotDeleteException
     * @return TicketRepositoryInterface
     */
    public function delete(TicketInterface $ticket) : TicketRepositoryInterface;

    /**
     * @param int $id
     * @throw CouldNotDeleteException
     * @return TicketRepositoryInterface
     */
    public function deleteById(int $id) : TicketRepositoryInterface;
}
