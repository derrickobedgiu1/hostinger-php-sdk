<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum FirewallAction: string
{
    case ACCEPT = 'accept';
    case DROP = 'drop';
}
