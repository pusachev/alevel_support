<?php


namespace ALevel\Support\Model\ResourceModel\Ticket;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use ALevel\Support\Model\ResourceModel\Status as ResourceModel;
use ALevel\Support\Model\Status as Model;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
