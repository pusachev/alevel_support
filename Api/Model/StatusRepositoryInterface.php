<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Api\Model;

use ALevel\Support\Api\Model\Data\StatusInterface;
use ALevel\Support\Api\Model\Data\StatusSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface StatusRepositoryInterface
 * @package ALevel\Support\Api\Model
 */
interface StatusRepositoryInterface
{
    /**
     * @param int $id
     * @throw NoSuchEntityException
     * @return StatusInterface
     */
    public function getById(int $id) : StatusInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return StatusSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : StatusSearchResultInterface;

    /**
     * @param StatusInterface $status
     * @throw CouldNotSaveException
     * @return StatusInterface
     */
    public function save(StatusInterface $status) : StatusInterface;

    /**
     * @param StatusInterface $status
     * @throw CouldNotDeleteException
     * @return StatusRepositoryInterface
     */
    public function delete(StatusInterface $status) : StatusRepositoryInterface;

    /**
     * @param int $id
     * @throw CouldNotDeleteException
     * @return StatusRepositoryInterface
     */
    public function deleteById(int $id) : StatusRepositoryInterface;
}
