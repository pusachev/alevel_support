<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Controller\Adminhtml\Status;

use Magento\Backend\App\Action;
use ALevel\Support\Api\Model\StatusRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Class InlineEdit
 * @package ALevel\Support\Controller\Adminhtml\Status
 */
class InlineEdit extends Action
{
    private $repository;

    public function __construct(
        Context $context,
        StatusRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct($context);
    }

    public function execute()
    {
        try {

        } catch (CouldNotDeleteException $e) {

        }
    }
}
