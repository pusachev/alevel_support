<?php

namespace ALevel\Support\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use ALevel\Support\Api\Model\Schema\StatusSchemaInterface;
use ALevel\Support\Api\Model\Schema\TicketsSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->createTicketsTable($setup);
        $this->createStatusTable($setup);

        $setup->getConnection()->addForeignKey(
            $setup->getFkName(
                $setup->getTable(TicketsSchemaInterface::TABLE_NAME),
                TicketsSchemaInterface::STATUS_COL_NAME,
                $setup->getTable(StatusSchemaInterface::TABLE_NAME),
                StatusSchemaInterface::STATUS_ID_COL_NAME
            ),
            $setup->getTable(TicketsSchemaInterface::TABLE_NAME),
            TicketsSchemaInterface::STATUS_COL_NAME,
            $setup->getTable(StatusSchemaInterface::TABLE_NAME),
            StatusSchemaInterface::STATUS_ID_COL_NAME,
            Table::ACTION_NO_ACTION
        );

        $setup->endSetup();
    }

    private function createTicketsTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(TicketsSchemaInterface::TABLE_NAME)
        )->addColumn(
            TicketsSchemaInterface::TICKET_ID_COL_NAME,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'ID'
        )->addColumn(
            TicketsSchemaInterface::FIRST_NAME_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => false],
            'Name'
        )->addColumn(
            TicketsSchemaInterface::LAST_NAME_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => true],
            'Name'
        )->addColumn(
            TicketsSchemaInterface::MESSAGE_COL_NAME,
            Table::TYPE_TEXT,
            null,
            ['nullable' => true]
        )->addColumn(
            TicketsSchemaInterface::STATUS_COL_NAME,
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned'=> true]
        )->addColumn(
            TicketsSchemaInterface::CREATED_AT_COL_NAME,
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Date of Last Flag Update'
        )->addColumn(
            TicketsSchemaInterface::UPDATED_AT_COL_NAME,
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => true,  'default' => Table::TIMESTAMP_INIT_UPDATE]
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable(TicketsSchemaInterface::TABLE_NAME),
                [TicketsSchemaInterface::FIRST_NAME_COL_NAME, TicketsSchemaInterface::MESSAGE_COL_NAME],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            [TicketsSchemaInterface::FIRST_NAME_COL_NAME, TicketsSchemaInterface::MESSAGE_COL_NAME],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'ALevel Support Tickets'
        );

        $setup->getConnection()->createTable($table);
    }

    private function createStatusTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(StatusSchemaInterface::TABLE_NAME)
        )->addColumn(
            StatusSchemaInterface::STATUS_ID_COL_NAME,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'ID'
        )->addColumn(
            StatusSchemaInterface::STATUS_CODE_COL_NAME,
            Table::TYPE_TEXT,
            16,
            ['nullable' => false],
            'Status code'
        )->addColumn(
            StatusSchemaInterface::STATUS_LABEL_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => true],
            'Status Label'
        )->addColumn(
            StatusSchemaInterface::IS_DEFAULT,
            Table::TYPE_SMALLINT,
            1,
            ['nullable' => false,  'default' => 0]
        )->addColumn(
            StatusSchemaInterface::IS_DELETED,
            Table::TYPE_SMALLINT,
            1,
            ['nullable' => false,  'default' => 0]
        )->setComment(
            'ALevel Support Tickets Status'
        );

        $setup->getConnection()->createTable($table);
    }
}