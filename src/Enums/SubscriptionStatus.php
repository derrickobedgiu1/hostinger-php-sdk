<?php

namespace DerrickOb\HostingerApi\Enums;

enum SubscriptionStatus: string
{
    case ACTIVE = 'active';
    case NOT_RENEWING = 'not_renewing';
}
