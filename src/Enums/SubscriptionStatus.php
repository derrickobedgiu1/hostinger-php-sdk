<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum SubscriptionStatus: string
{
    case ACTIVE = 'active';
    case NOT_RENEWING = 'not_renewing';
    case CANCELLED = 'cancelled';
    case PAUSED = 'paused';
    case TRANSFERRED = 'transferred';
    case IN_TRIAL = 'in_trial';
    case FUTURE = 'future';
}
