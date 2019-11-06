<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2018, Pavel Usachev
 */

namespace ALevel\Support\Block\Adminhtml\Status\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

use ALevel\Support\Api\Model\StatusRepositoryInterface;

class GenericButton
{
    /** @var Context */
    protected $context;

    /** @var StatusRepositoryInterface */
    protected $repository;

    public function __construct(
        Context $context,
        StatusRepositoryInterface $repository
    ) {
        $this->context      = $context;
        $this->repository   = $repository;
    }

    /**
     * Return Lesson ID
     *
     * @return int|null
     */
    public function getStatusId()
    {
        try {
            return $this->repository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}