<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Model;

use ALevel\Support\Api\Model\Data\StatusInterface;
use ALevel\Support\Api\Model\Data\TicketInterface;
use ALevel\Support\Api\Model\Schema\TicketsSchemaInterface;
use ALevel\Support\Model\ResourceModel\Ticket as ResourceModel;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\Model\Context;

/**
 * Class Ticket
 * @package ALevel\Support\Model
 */
class Ticket extends AbstractModel implements TicketInterface
{
    /**
     * @var StatusInterface
     */
    private $status;

    /**
     * @var TimezoneInterface
     */
    private $timezone;

    /**
     * Ticket constructor.
     *
     * @param Context                    $context
     * @param Registry                  $registry
     * @param TimezoneInterface         $timezone
     * @param AbstractResource|null     $resource
     * @param AbstractDb|null           $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        TimezoneInterface $timezone,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->timezone = $timezone;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /** {@inheritDoc} */
    public function getId(): ?int
    {
        return parent::getId();
    }

    /** {@inheritDoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritDoc} */
    public function setFirstName(string $firstName): TicketInterface
    {
        $this->setData(TicketsSchemaInterface::FIRST_NAME_COL_NAME, $firstName);

        return $this;
    }

    /** {@inheritDoc} */
    public function getFirstName(): string
    {
        return $this->getData(TicketsSchemaInterface::FIRST_NAME_COL_NAME);
    }

    /** {@inheritDoc} */
    public function setLastName(string $lastName): TicketInterface
    {
        $this->setData(TicketsSchemaInterface::LAST_NAME_COL_NAME, $lastName);

        return $this;
    }

    /** {@inheritDoc} */
    public function getLastName(): string
    {
        return $this->getData(TicketsSchemaInterface::LAST_NAME_COL_NAME);
    }

    /** {@inheritDoc} */
    public function setMessage(string $message): TicketInterface
    {
        $this->setData(TicketsSchemaInterface::MESSAGE_COL_NAME, $message);

        return $this;
    }

    /** {@inheritDoc} */
    public function getMessage(): string
    {
        return $this->getData(TicketsSchemaInterface::MESSAGE_COL_NAME);
    }

    /** {@inheritDoc} */
    public function setStatus(StatusInterface $status): TicketInterface
    {
        if (null === $status->getId()) {
            throw new LocalizedException(__('Status not created'));
        }

        $this->setData(TicketsSchemaInterface::STATUS_COL_NAME, $status->getId());

        return $this;
    }

    /** {@inheritDoc} */
    public function getStatus(): StatusInterface
    {
        $statusId =  $this->getData(TicketsSchemaInterface::STATUS_COL_NAME);

        if (null === $this->status) {
            // @TODO load status by ID
        }

        return $this->status;
    }

    /** {@inheritDoc} */
    public function getCreatedAt(): string
    {
        $timestamp = $this->getData(TicketsSchemaInterface::CREATED_AT_COL_NAME);

        return $this->timezone->date($timestamp)->format('Y-m-d H:i:s');
    }

    /** {@inheritDoc} */
    public function getUpdatedAt(): string
    {
        $timestamp = $this->getData(TicketsSchemaInterface::UPDATED_AT_COL_NAME);

        return $this->timezone->date($timestamp)->format('Y-m-d H:i:s');
    }
}
