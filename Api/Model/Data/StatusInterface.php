<?php
/**
 * @author    Pavel Usachev <pausachev@gmail.com>
 * @copyright 2019 Pavel Usachev
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace ALevel\Support\Api\Model\Data;

/**
 * Interface StatusInterface
 * @package ALevel\Support\Api\Model\Data
 */
interface StatusInterface
{
    /**
     * @return int|null
     */
    public function getId() : ?int;

    /**
     * @param string $code
     * @return StatusInterface
     */
    public function setStatusCode(string $code) : StatusInterface;

    /**
     * @return string
     */
    public function getStatusCode() : string;

    /**
     * @param string $label
     * @return StatusInterface
     */
    public function setLabel(string $label) : StatusInterface;

    /**
     * @return string
     */
    public function getLabel() : string;

    /**
     * @param bool $default
     * @return StatusInterface
     */
    public function setIsDefault(bool $default) : StatusInterface;

    /**
     * @return bool
     */
    public function getIsDefault() : bool;

    /**
     * @param bool $deleted
     * @return StatusInterface
     */
    public function setIsDeleted(bool $deleted) : StatusInterface;

    /**
     * @return bool
     */
    public function getIsDeleted() : bool;
}
