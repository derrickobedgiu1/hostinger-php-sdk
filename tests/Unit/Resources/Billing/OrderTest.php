<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\Order as OrderData;
use DerrickOb\HostingerApi\Enums\OrderStatus;
use DerrickOb\HostingerApi\Resources\Billing\Order;
use Faker\Generator;

test('can create new service order', function (): void {
    /** @var Generator $faker */
    $faker = faker();

    $orderResponse = [
        'id' => $faker->randomNumber(7),
        'status' => OrderStatus::COMPLETED->value,
        'currency' => 'USD',
        'subtotal' => $faker->numberBetween(500, 10000),
        'total' => $faker->numberBetween(10000, 20000),
        'billing_address' => [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'company' => $faker->optional()->company(),
            'address_1' => $faker->optional()->streetAddress(),
            'address_2' => $faker->optional()->streetAddress(),
            'city' => $faker->optional()->city(),
            'state' => $faker->optional()->city(),
            'zip' => $faker->optional()->postcode(),
            'country' => $faker->countryCode(),
            'phone' => $faker->optional()->phoneNumber(),
            'email' => $faker->email(),
        ],
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d\TH:i:s\Z'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d\TH:i:s\Z'),
    ];

    $orderRequest = [
        'payment_method_id' => $faker->randomNumber(6),
        'items' => [
            [
                'item_id' => 'hostingercom-vps-kvm2-usd-1m',
                'quantity' => 1,
            ],
        ],
        'coupons' => ['DISCOUNT10'],
    ];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/billing/v1/orders', $orderRequest)
        ->once()
        ->andReturn($orderResponse);

    $resource = new Order($client);
    $response = $resource->create($orderRequest);

    expect($response)->toBeInstanceOf(OrderData::class)
        ->and($response->id)->toBe($orderResponse['id'])
        ->and($response->status)->toBe(OrderStatus::COMPLETED)
        ->and($response->currency)->toBe($orderResponse['currency'])
        ->and($response->subtotal)->toBe($orderResponse['subtotal'])
        ->and($response->total)->toBe($orderResponse['total'])
        ->and($response->billing_address->first_name)->toBe($orderResponse['billing_address']['first_name'])
        ->and($response->billing_address->email)->toBe($orderResponse['billing_address']['email']);
});
