<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Model;

use ALevel\Support\Api\Model\Data\StatusInterface;
use ALevel\Support\Api\Model\Schema\StatusSchemaInterface;
use ALevel\Support\Model\ResourceModel\Status as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Status
 * @package ALevel\Support\Model
 */
class Status extends AbstractModel implements StatusInterface
{
    /** {@inheritDoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return parent::getId();
    }

    /** {@inheritDoc} */
    public function setStatusCode(string $code): StatusInterface
    {
        $this->setData(StatusSchemaInterface::STATUS_CODE_COL_NAME, $code);

        return $this;
    }

    /** {@inheritDoc} */
    public function getStatusCode(): string
    {
        return $this->getData(StatusSchemaInterface::STATUS_CODE_COL_NAME);
    }

    /** {@inheritDoc} */
    public function setLabel(string $label): StatusInterface
    {
        $this->setData(StatusSchemaInterface::STATUS_LABEL_COL_NAME, $label);

        return $this;
    }

    /** {@inheritDoc} */
    public function getLabel(): string
    {
        return $this->getData(StatusSchemaInterface::STATUS_LABEL_COL_NAME);
    }

    /** {@inheritDoc} */
    public function setIsDefault(bool $default): StatusInterface
    {
        $this->setData(StatusSchemaInterface::IS_DEFAULT, (int) $default);

        return $this;
    }

    /** {@inheritDoc} */
    public function getIsDefault(): bool
    {
        return (bool)$this->getData(StatusSchemaInterface::IS_DEFAULT);
    }

    /** {@inheritDoc} */
    public function setIsDeleted(bool $deleted): StatusInterface
    {
        $this->setData(StatusSchemaInterface::IS_DELETED, (int) $deleted);

        return $this;
    }

    /** {@inheritDoc} */
    public function getIsDeleted(): bool
    {
        return (bool)$this->getData(StatusSchemaInterface::IS_DELETED);
    }
}
