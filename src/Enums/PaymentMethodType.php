<?php

namespace DerrickOb\HostingerApi\Enums;

enum PaymentMethodType: string
{
    case CARD = 'card';
    case PAYPAL = 'paypal';
}
