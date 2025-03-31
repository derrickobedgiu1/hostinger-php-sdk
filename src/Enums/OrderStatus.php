<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum OrderStatus: string
{
    case COMPLETED = 'completed';
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
    case CANCELLED = 'cancelled';
    case AWAITING_PAYMENT = 'awaiting_payment';
    case PAYMENT_INITIATED = 'payment_initiated';
    case FRAUD_REFUND = 'fraud_refund';
}
