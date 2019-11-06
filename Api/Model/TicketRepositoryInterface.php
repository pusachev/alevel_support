<?php


namespace ALevel\Support\Api\Model;


use ALevel\Support\Api\Model\Data\TicketInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;

interface TicketRepositoryInterface
{
    public function getById(int $id) : TicketInterface;

    public function getList(SearchCriteriaInterface $searchCriteria) : SearchResultInterface;

    public function save(TicketInterface $ticket) : TicketInterface;

    public function delete(TicketInterface $ticket) : TicketRepositoryInterface;

    public function deleteById(int $id) : TicketRepositoryInterface;
}
