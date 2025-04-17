<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum VirtualMachineState: string
{
    case RUNNING = 'running';
    case STARTING = 'starting';
    case STOPPING = 'stopping';
    case STOPPED = 'stopped';
    case CREATING = 'creating';
    case INITIAL = 'initial';
    case ERROR = 'error';
    case SUSPENDING = 'suspending';
    case UNSUSPENDING = 'unsuspending';
    case SUSPENDED = 'suspended';
    case DESTROYING = 'destroying';
    case DESTROYED = 'destroyed';
    case RECREATING = 'recreating';
    case RESTORING = 'restoring';
    case RECOVERY = 'recovery';
    case STOPPING_RECOVERY = 'stopping_recovery';
}
