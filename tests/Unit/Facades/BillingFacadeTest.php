<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Facades;

use DerrickOb\HostingerApi\Facades\BillingFacade;
use DerrickOb\HostingerApi\Resources\Billing\Catalog;
use DerrickOb\HostingerApi\Resources\Billing\Order;
use DerrickOb\HostingerApi\Resources\Billing\PaymentMethod;
use DerrickOb\HostingerApi\Resources\Billing\Subscription;

test('can access the catalog resource', function (): void {
    $client = createMockClient();
    $facade = new BillingFacade($client);
    expect($facade->catalog())->toBeInstanceOf(Catalog::class);
});

test('can access the order resource', function (): void {
    $client = createMockClient();
    $facade = new BillingFacade($client);
    expect($facade->orders())->toBeInstanceOf(Order::class);
});

test('can access the payment method resource', function (): void {
    $client = createMockClient();
    $facade = new BillingFacade($client);
    expect($facade->paymentMethods())->toBeInstanceOf(PaymentMethod::class);
});

test('can access the subscription resource', function (): void {
    $client = createMockClient();
    $facade = new BillingFacade($client);
    expect($facade->subscriptions())->toBeInstanceOf(Subscription::class);
});
