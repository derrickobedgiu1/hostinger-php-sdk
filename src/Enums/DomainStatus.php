<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum DomainStatus: string
{
    case ACTIVE = 'active';
    case PENDING_SETUP = 'pending_setup';
    case EXPIRED = 'expired';
}
