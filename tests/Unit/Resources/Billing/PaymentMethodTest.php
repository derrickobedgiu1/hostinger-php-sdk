<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\PaymentMethod as PaymentMethodData;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Enums\PaymentMethodType;
use DerrickOb\HostingerApi\Resources\Billing\PaymentMethod;

test('can list payment methods', function (): void {
    $faker = faker();

    $paymentMethods = [];

    for ($i = 0; $i < 3; $i++) {
        $paymentMethods[] = [
            'id' => $faker->randomNumber(7),
            'name' => $faker->randomElement(['Credit Card', 'PayPal']),
            'identifier' => $faker->creditCardNumber(),
            'payment_method' => $i === 0 ? PaymentMethodType::CARD->value : PaymentMethodType::PAYPAL->value,
            'is_default' => $i === 0,
            'is_expired' => false,
            'is_suspended' => false,
            'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d\TH:i:s\Z'),
            'expires_at' => $faker->dateTimeThisYear()->format('Y-m-d\TH:i:s\Z'),
        ];
    }

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/billing/v1/payment-methods')
        ->once()
        ->andReturn($paymentMethods);

    $resource = new PaymentMethod($client);
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(3)
        ->and($response[0])->toBeInstanceOf(PaymentMethodData::class)
        ->and($response[0]->id)->toBe($paymentMethods[0]['id'])
        ->and($response[0]->name)->toBe($paymentMethods[0]['name'])
        ->and($response[0]->identifier)->toBe($paymentMethods[0]['identifier'])
        ->and($response[0]->payment_method)->toBe(PaymentMethodType::CARD)
        ->and($response[0]->is_default)->toBeTrue()
        ->and($response[1]->is_default)->toBeFalse()
        ->and($response[1]->payment_method)->toBe(PaymentMethodType::PAYPAL);
});

test('can set default payment method', function (): void {
    $faker = faker();
    $paymentMethodId = $faker->randomNumber(7);

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/billing/v1/payment-methods/' . $paymentMethodId)
        ->once()
        ->andReturn($successResponse);

    $resource = new PaymentMethod($client);
    $response = $resource->setDefault($paymentMethodId);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can delete payment method', function (): void {
    $faker = faker();
    $paymentMethodId = $faker->randomNumber(7);

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/billing/v1/payment-methods/' . $paymentMethodId)
        ->once()
        ->andReturn($successResponse);

    $resource = new PaymentMethod($client);
    $response = $resource->delete($paymentMethodId);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});
