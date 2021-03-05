<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Setup\Patch\Data;

use ALevel\Support\Api\Model\Schema\StatusSchemaInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\DB\TransactionFactory;
use ALevel\Support\Api\Model\Data\StatusInterfaceFactory;

/**
 * Class FillStatusTable
 * @package ALevel\Support\Setup\Patch\Data
 */
class FillStatusTable implements DataPatchInterface
{
    /**
     * @var TransactionFactory
     */
    private $transactionModel;

    /**
     * @var StatusInterfaceFactory
     */
    private $modelFactory;

    public function __construct(
        TransactionFactory $transactionFactory,
        StatusInterfaceFactory $statusInterfaceFactory
    ) {
        $this->transactionModel = $transactionFactory;
        $this->modelFactory     = $statusInterfaceFactory;
    }

    /** {@inheritDoc} */
    public static function getDependencies()
    {
        return [];
    }

    /** {@inheritDoc} */
    public function getAliases()
    {
        return [];
    }

    /** {@inheritDoc} */
    public function apply()
    {
        $statusData = [
            [
                StatusSchemaInterface::STATUS_CODE_COL_NAME => 'pending',
                StatusSchemaInterface::STATUS_LABEL_COL_NAME => 'Pending',
            ],
            [
                StatusSchemaInterface::STATUS_CODE_COL_NAME => 'close',
                StatusSchemaInterface::STATUS_LABEL_COL_NAME => 'Close',
            ],
            [
                StatusSchemaInterface::STATUS_CODE_COL_NAME => 'process',
                StatusSchemaInterface::STATUS_LABEL_COL_NAME => 'Process',
            ],
        ];

        $transactionalModel = $this->transactionModel->create();

        foreach ($statusData as $data) {
            $model = $this->modelFactory->create();
            $model->addData($data);
            $transactionalModel->addObject($model);
        }

        $transactionalModel->save();
    }
}
