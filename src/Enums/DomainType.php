<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum DomainType: string
{
    case DOMAIN = 'domain';
    case FREE_DOMAIN = 'free_domain';
}
