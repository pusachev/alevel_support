<?php


namespace ALevel\Support\Api\Model;

use ALevel\Support\Api\Model\Data\StatusInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;

interface StatusRepositoryInterface
{
    public function getById(int $id) : StatusInterface;

    public function getList(SearchCriteriaInterface $searchCriteria) : SearchResultInterface;

    public function save(StatusInterface $status) : StatusInterface;

    public function delete(StatusInterface $status) : StatusRepositoryInterface;

    public function deleteById(int $id) : StatusRepositoryInterface;
}