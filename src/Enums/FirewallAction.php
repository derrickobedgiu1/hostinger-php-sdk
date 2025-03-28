<?php

namespace DerrickOb\HostingerApi\Enums;

enum FirewallAction: string
{
    case ACCEPT = 'accept';
    case DROP = 'drop';
}
