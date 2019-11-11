<?php


namespace ALevel\Support\Api\Model\Data;

interface StatusInterface
{
    /**
     * @return int|null
     */
    public function getId();

    public function setStatusCode(string $code) : StatusInterface;

    public function getStatusCode() : string;

    public function setLabel(string $label) : StatusInterface;

    public function getLabel() : string;

    public function setIsDefault(bool $default) : StatusInterface;

    public function getIsDefault() : bool;

    public function setIsDeleted(bool $deleted) : StatusInterface;

    public function getIsDeleted() : bool;
}