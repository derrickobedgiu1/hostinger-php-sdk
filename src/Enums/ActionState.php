<?php

namespace DerrickOb\HostingerApi\Enums;

enum ActionState: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
    case DELAYED = 'delayed';
    case SENT = 'sent';
    case CREATED = 'created';
}
