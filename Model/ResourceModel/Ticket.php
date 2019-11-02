<?php


namespace ALevel\Support\Model\ResourceModel;

use ALevel\Support\Api\Model\Schema\TicketsSchemaInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Ticket extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TicketsSchemaInterface::TABLE_NAME, TicketsSchemaInterface::TICKET_ID_COL_NAME);
    }
}