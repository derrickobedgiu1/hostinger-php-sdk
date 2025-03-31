<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Enums;

enum PaymentMethodType: string
{
    case CARD = 'card';
    case PAYPAL = 'paypal';
    case GOOGLE_PAY = 'googlepay';
}
