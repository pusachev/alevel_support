<?php


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

class Ticket extends AbstractModel implements TicketInterface
{
    private $statusRepository;

    /**
     * @var StatusInterface
     */
    private $status;

    /**
     * @var TimezoneInterface
     */
    private $timezone;

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

    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function setFirstName(string $firstName): TicketInterface
    {
        $this->setData(TicketsSchemaInterface::FIRST_NAME_COL_NAME, $firstName);

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->getData(TicketsSchemaInterface::FIRST_NAME_COL_NAME);
    }

    public function setLastName(string $lastName): TicketInterface
    {
        $this->setData(TicketsSchemaInterface::LAST_NAME_COL_NAME, $lastName);

        return $this;
    }

    public function getLastName(): string
    {
        return $this->getData(TicketsSchemaInterface::LAST_NAME_COL_NAME);
    }

    public function setMessage(string $message): TicketInterface
    {
        $this->setData(TicketsSchemaInterface::MESSAGE_COL_NAME, $message);

        return $this;
    }

    public function getMessage(): string
    {
        return $this->getData(TicketsSchemaInterface::MESSAGE_COL_NAME);
    }

    public function setStatus(StatusInterface $status): TicketInterface
    {
        if (null === $status->getId()) {
            throw new LocalizedException(__('Status not created'));
        }

        $this->setData(TicketsSchemaInterface::STATUS_COL_NAME, $status->getId());

        return $this;
    }

    public function getStatus(): StatusInterface
    {
        $statusId =  $this->getData(TicketsSchemaInterface::STATUS_COL_NAME);

        if (null === $this->status) {
            // @TODO load status by ID
        }

        return $this->status;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        $timestamp = $this->getData(TicketsSchemaInterface::CREATED_AT_COL_NAME);

        return $this->timezone->date($timestamp);
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        $timestamp = $this->getData(TicketsSchemaInterface::UPDATED_AT_COL_NAME);

        return $this->timezone->date($timestamp);
    }
}
