<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\Subscription as SubscriptionData;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Enums\PeriodUnit;
use DerrickOb\HostingerApi\Enums\SubscriptionStatus;
use DerrickOb\HostingerApi\Resources\Billing\Subscription;

test('can list subscriptions', function (): void {
    $faker = faker();

    $subscriptions = [];

    for ($i = 0; $i < 2; $i++) {
        $createdAt = $faker->dateTimeThisYear();
        $expiresAt = (clone $createdAt)->modify('+1 year');
        $nextBillingAt = (clone $createdAt)->modify('+1 month');

        $subscriptions[] = [
            'id' => $faker->regexify('[A-Za-z0-9]{15}'),
            'name' => 'KVM ' . $faker->numberBetween(1, 4),
            'status' => $i === 0 ? SubscriptionStatus::ACTIVE->value : SubscriptionStatus::NOT_RENEWING->value,
            'billing_period' => $faker->randomElement([1, 3, 6, 12]),
            'billing_period_unit' => $faker->randomElement(array_column(PeriodUnit::cases(), 'value')),
            'currency_code' => 'USD',
            'total_price' => $faker->numberBetween(1000, 5000),
            'renewal_price' => $faker->numberBetween(1000, 5000),
            'auto_renew' => $faker->boolean(),
            'created_at' => $createdAt->format('Y-m-d\TH:i:s\Z'),
            'expires_at' => $expiresAt->format('Y-m-d\TH:i:s\Z'),
            'next_billing_at' => $nextBillingAt->format('Y-m-d\TH:i:s\Z'),
        ];
    }

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/billing/v1/subscriptions')
        ->once()
        ->andReturn($subscriptions);

    $resource = new Subscription($client);

    /** @var array<SubscriptionData> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(2)
        ->and($response[0])->toBeInstanceOf(SubscriptionData::class)
        ->and($response[0]->id)->toBe($subscriptions[0]['id'])
        ->and($response[0]->name)->toBe($subscriptions[0]['name'])
        ->and($response[0]->status)->toBe(SubscriptionStatus::ACTIVE)
        ->and($response[0]->billing_period)->toBe($subscriptions[0]['billing_period'])
        ->and($response[1]->status)->toBe(SubscriptionStatus::NOT_RENEWING);

    $periodUnit = PeriodUnit::from($subscriptions[0]['billing_period_unit']);
    expect($response[0]->billing_period_unit)->toBe($periodUnit);
});

test('can cancel subscription', function (): void {
    $faker = faker();
    $subscriptionId = $faker->regexify('[A-Za-z0-9]{15}');

    $data = [
        'reason_code' => 'too_expensive',
        'cancel_option' => 'immediate',
    ];

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/billing/v1/subscriptions/' . $subscriptionId, $data)
        ->once()
        ->andReturn($successResponse);

    $resource = new Subscription($client);
    $response = $resource->cancel($subscriptionId, $data);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can cancel subscription without additional data', function (): void {
    $faker = faker();
    $subscriptionId = $faker->regexify('[A-Za-z0-9]{15}');

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/billing/v1/subscriptions/' . $subscriptionId, [])
        ->once()
        ->andReturn($successResponse);

    $resource = new Subscription($client);
    $response = $resource->cancel($subscriptionId);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});
