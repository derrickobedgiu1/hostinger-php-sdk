<?php

namespace DerrickOb\HostingerApi\Enums;

enum OrderStatus: string
{
    case COMPLETED = 'completed';
    case PENDING = 'pending';
}
