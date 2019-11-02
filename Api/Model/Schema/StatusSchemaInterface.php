<?php


namespace ALevel\Support\Api\Model\Schema;

interface StatusSchemaInterface
{
    const TABLE_NAME = 'alevel_support_status';

    const STATUS_ID_COL_NAME    = 'status_id';
    const STATUS_CODE_COL_NAME  = 'status_code';
    const STATUS_LABEL_COL_NAME = 'label';
    const IS_DELETED            = 'is_deleted';
    const IS_DEFAULT            = 'is_default';
}
