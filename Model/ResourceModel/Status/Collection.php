<?php


namespace ALevel\Support\Model\ResourceModel\Status;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use ALevel\Support\Model\Ticket as Model;
use ALevel\Support\Model\ResourceModel\Ticket as ResourceModel;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}