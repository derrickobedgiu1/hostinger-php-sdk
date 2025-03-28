<?php

namespace DerrickOb\HostingerApi\Enums;

enum ActionsLock: string
{
    case UNLOCKED = 'unlocked';
    case LOCKED = 'locked';
}
