<?php


namespace ALevel\Support\Controller\Adminhtml\Status;

use Psr\Log\LoggerInterface;

use ALevel\Support\Api\Model\StatusRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use ALevel\Support\Api\Model\Data\StatusInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractModel;

class Save extends Action
{

    /**
     * @var StatusInterfaceFactory
     */
    private $modelFactory;

    /**
     * @var StatusRepositoryInterface
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        Context $context,
        StatusInterfaceFactory $statusInterfaceFactory,
        StatusRepositoryInterface $repository,
        LoggerInterface $logger
    ) {
        $this->repository       = $repository;
        $this->modelFactory     = $statusInterfaceFactory;
        $this->logger           = $logger;

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

        /** @var AbstractModel $model */
        $model = $this->modelFactory->create();

        $model->addData($params);
        $model->setLabel($params['label']);

        try {
            $this->repository->save($model);
            $this->messageManager->addSuccessMessage('Saved!');
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Error');
        }

        return  $this->_redirect('*/*/');
    }
}