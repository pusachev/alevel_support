<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Controller\Adminhtml\Status;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/***
 * Class Edit
 * @package ALevel\Support\Controller\Adminhtml\Status
 */
class Edit extends Action
{
    const ADMIN_RESOURCE = 'ALevel_Support::status_edit';

    /** {@inheritDoc} */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
