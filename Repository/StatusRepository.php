<?php

namespace ALevel\Support\Repository;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

use ALevel\Support\Api\Model\Data\StatusInterface;
use ALevel\Support\Api\Model\Data\StatusInterfaceFactory;
use ALevel\Support\Api\Model\StatusRepositoryInterface;
use ALevel\Support\Model\ResourceModel\Status as ResourceModel;
use ALevel\Support\Model\ResourceModel\Status\Collection;
use ALevel\Support\Model\ResourceModel\Status\CollectionFactory;
use ALevel\Support\Api\Model\Data\StatusSearchResultInterface;
use ALevel\Support\Api\Model\Data\StatusSearchResultInterfaceFactory;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class StatusRepository implements StatusRepositoryInterface
{
    private $resourceModel;

    private $modelFactory;

    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var StatusSerachResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        ResourceModel $resourceModel,
        StatusInterfaceFactory $statusInterfaceFactory,
        CollectionFactory $collectionFactory,
        StatusSearchResultInterfaceFactory $searchResultFactory,
        CollectionProcessorInterface $collectionProcessor,
        LoggerInterface $logger
    ) {
        $this->resourceModel        = $resourceModel;
        $this->modelFactory         = $statusInterfaceFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultFactory  = $searchResultFactory;
        $this->collectionProcessor  = $collectionProcessor;
        $this->logger               = $logger;
    }

    public function getById(int $id): StatusInterface
    {
         $model = $this->modelFactory->create();

         $this->resourceModel->load($model, $id);

         if (null === $model->getId()) {
             throw new NoSuchEntityException(__('Model with %1 not found', $id));
         }

         return $model;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultFactory->create();

        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getData());

        return $searchResult;
    }

    public function save(StatusInterface $status): StatusInterface
    {
        try {
            $this->resourceModel->save($status);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__("Status not saved"));
        }

        return  $this;
    }

    public function delete(StatusInterface $status): StatusRepositoryInterface
    {
        try {
            $this->resourceModel->delete($status);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__("Status %1 not deleted", $status->getId()));
        }
    }

    public function deleteById(int $id): StatusRepositoryInterface
    {
        try {
            $model = $this->getById($id);
            $this->delete($model);
        } catch (NoSuchEntityException $e) {
            $this->logger->warning(sprintf("Status %d already deleted or not found", $id));
        }

        return $this;
    }
}
