<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\Forwarding as ForwardingData;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Resources\Domain\Forwarding;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can get forwarding data', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $forwardingData = TestFactory::forwarding(['domain' => $domain]);

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/domains/v1/forwarding/' . $domain)
        ->once()
        ->andReturn($forwardingData);

    $resource = new Forwarding($client);
    $response = $resource->get($domain);

    expect($response)->toBeInstanceOf(ForwardingData::class)
        ->and($response->domain)->toBe($domain)
        ->and($response->redirect_type)->toBe($forwardingData['redirect_type'])
        ->and($response->redirect_url)->toBe($forwardingData['redirect_url']);
});

test('can create forwarding data', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $redirectUrl = $faker->url();
    $redirectType = '301';

    $requestData = [
        'domain' => $domain,
        'redirect_type' => $redirectType,
        'redirect_url' => $redirectUrl,
    ];

    $responseData = TestFactory::forwarding([
        'domain' => $domain,
        'redirect_type' => $redirectType,
        'redirect_url' => $redirectUrl,
    ]);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/domains/v1/forwarding', $requestData)
        ->once()
        ->andReturn($responseData);

    $resource = new Forwarding($client);
    $response = $resource->create($requestData);

    expect($response)->toBeInstanceOf(ForwardingData::class)
        ->and($response->domain)->toBe($domain)
        ->and($response->redirect_type)->toBe($redirectType)
        ->and($response->redirect_url)->toBe($redirectUrl);
});

test('can delete forwarding data', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/domains/v1/forwarding/' . $domain)
        ->once()
        ->andReturn($successResponse);

    $resource = new Forwarding($client);
    $response = $resource->delete($domain);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});
