<?php


namespace ALevel\Support\Controller\Adminhtml\Status;

use ALevel\Support\Api\Model\StatusRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{

    private $repository;

    public function __construct(
        Action\Context $context,
        StatusRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();



    }
}