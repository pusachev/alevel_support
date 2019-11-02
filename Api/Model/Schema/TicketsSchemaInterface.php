<?php

namespace ALevel\Support\Api\Model\Schema;

interface TicketsSchemaInterface
{
    const TABLE_NAME = 'alevel_support_tickets';

    const TICKET_ID_COL_NAME    = 'ticket_id';
    const FIRST_NAME_COL_NAME   = 'first_name';
    const LAST_NAME_COL_NAME    = 'last_name';
    const MESSAGE_COL_NAME      = 'message';
    const CREATED_AT_COL_NAME   = 'created_at';
    const UPDATED_AT_COL_NAME   = 'updated_at';
    const STATUS_COL_NAME       = 'status';
}
