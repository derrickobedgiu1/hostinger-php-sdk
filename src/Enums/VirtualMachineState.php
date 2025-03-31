<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum VirtualMachineState: string
{
    case RUNNING = 'running';
    case STOPPED = 'stopped';
    case CREATING = 'creating';
    case INITIAL = 'initial';
}
