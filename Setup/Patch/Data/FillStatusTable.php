<?php


namespace ALevel\Support\Setup\Patch\Data;

use ALevel\Support\Api\Model\Schema\StatusSchemaInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\DB\TransactionFactory;
use ALevel\Support\Api\Model\Data\StatusInterfaceFactory;

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

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - than under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
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
