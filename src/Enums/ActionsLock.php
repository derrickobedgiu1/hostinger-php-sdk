<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum ActionsLock: string
{
    case UNLOCKED = 'unlocked';
    case LOCKED = 'locked';
}
