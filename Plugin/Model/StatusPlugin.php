<?php


namespace ALevel\Support\Plugin\Model;


use ALevel\Support\Api\Model\Data\StatusInterface;

class StatusPlugin
{
    public function beforeSetLabel(StatusInterface $status, $label)
    {
        return [
           sprintf("{%s}", $label)
        ];
    }

    public function afterGetStatusCode(StatusInterface $status, $result)
    {
        return sprintf("|%s|", $result);
    }
}