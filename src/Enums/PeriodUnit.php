<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum PeriodUnit: string
{
    case MONTH = 'month';
    case YEAR = 'year';
    case DAY = 'day';
    case WEEK = 'week';
    case NONE = 'none';
}
