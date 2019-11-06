<?php


namespace ALevel\Support\Repository;


use ALevel\Support\Api\Model\Data\TicketSearchResultInterface;
use ALevel\Support\Api\Model\Data\TicketSearchResultInterfaceFactory;
use ALevel\Support\Api\Model\TicketRepositoryInterface;
use ALevel\Support\Model\ResourceModel\Ticket as ResourceModel;
use ALevel\Support\Api\Model\Data\TicketInterface;
use ALevel\Support\Api\Model\Data\TicketInterfaceFactory;
use ALevel\Support\Model\ResourceModel\Ticket\Collection;
use ALevel\Support\Model\ResourceModel\Ticket\CollectionFactory;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class TicketsRepository implements TicketRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * @var TicketInterfaceFactory\
     */
    private $modelFactory;

    /**
     * @var CollectionFactory\
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var TicketSearchResultInterface
     */
    private $searchResultFactory;

    public function __construct(
        ResourceModel $resourceModel,
        TicketInterfaceFactory $ticketInterfaceFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        TicketSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->resourceModel        = $resourceModel;
        $this->modelFactory         = $ticketInterfaceFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->collectionProcessor  = $collectionProcessor;
        $this->searchResultFactory  = $searchResultInterfaceFactory;
    }

    public function getById(int $id): TicketInterface
    {
        $model = $this->modelFactory->create();

        $this->resourceModel->load($model, $id);

        if (null === $model->getId()) {
            throw new NoSuchEntityException(__("Ticket %1 not found", $id));
        }

        return $model;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
    {
        // TODO: Implement getList() method.
    }

    public function save(TicketInterface $ticket): TicketInterface
    {
        // TODO: Implement save() method.
    }

    public function delete(TicketInterface $ticket): TicketRepositoryInterface
    {
        // TODO: Implement delete() method.
    }

    public function deleteById(int $id): TicketRepositoryInterface
    {
        // TODO: Implement deleteById() method.
    }
}