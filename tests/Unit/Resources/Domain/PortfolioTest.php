<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Domain;

use DerrickOb\HostingerApi\Data\Billing\Order as OrderData;
use DerrickOb\HostingerApi\Data\Domain\Domain;
use DerrickOb\HostingerApi\Data\Domain\DomainExtended;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Enums\DomainStatus;
use DerrickOb\HostingerApi\Enums\DomainType;
use DerrickOb\HostingerApi\Resources\Domain\Portfolio;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list domains in portfolio', function (): void {
    $domains = [
        TestFactory::domain(['domain' => 'example1.com', 'type' => DomainType::DOMAIN->value, 'status' => DomainStatus::ACTIVE->value]),
        TestFactory::domain(['domain' => 'example2.com', 'type' => DomainType::DOMAIN->value, 'status' => DomainStatus::ACTIVE->value]),
        TestFactory::domain(['domain' => null, 'type' => DomainType::FREE_DOMAIN->value, 'status' => DomainStatus::PENDING_SETUP->value]),
        TestFactory::domain(['domain' => 'example3.com', 'type' => DomainType::DOMAIN->value, 'status' => DomainStatus::REQUESTED->value]),
        TestFactory::domain(['domain' => 'example4.com', 'type' => DomainType::DOMAIN->value, 'status' => DomainStatus::PENDING_VERIFICATION->value]),
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/domains/v1/portfolio')
        ->once()
        ->andReturn($domains);

    $resource = new Portfolio($client);

    /** @var array<Domain> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(5)
        ->and($response[0])->toBeInstanceOf(Domain::class)
        ->and($response[0]->domain)->toBe('example1.com')
        ->and($response[0]->type)->toBe(DomainType::DOMAIN)
        ->and($response[0]->status)->toBe(DomainStatus::ACTIVE)
        ->and($response[1])->toBeInstanceOf(Domain::class)
        ->and($response[1]->domain)->toBe('example2.com')
        ->and($response[2])->toBeInstanceOf(Domain::class)
        ->and($response[2]->domain)->toBeNull()
        ->and($response[2]->type)->toBe(DomainType::FREE_DOMAIN)
        ->and($response[2]->status)->toBe(DomainStatus::PENDING_SETUP)
        ->and($response[3]->status)->toBe(DomainStatus::REQUESTED)
        ->and($response[4]->status)->toBe(DomainStatus::PENDING_VERIFICATION);
});

test('can get extended domain details', function (): void {
    $faker = faker();
    $domainName = $faker->domainName();
    $domainData = TestFactory::domainExtended(['domain' => $domainName]);

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/domains/v1/portfolio/' . $domainName)
        ->once()
        ->andReturn($domainData);

    $resource = new Portfolio($client);
    $response = $resource->get($domainName);

    expect($response)->toBeInstanceOf(DomainExtended::class)
        ->and($response->domain)->toBe($domainName)
        ->and($response->status)->toBeInstanceOf(DomainStatus::class)
        ->and($response->is_locked)->toBe($domainData['is_locked'])
        ->and($response->is_privacy_protected)->toBe($domainData['is_privacy_protected'])
        ->and($response->name_servers)->toBe($domainData['name_servers']);
});

test('can purchase a new domain', function (): void {
    $faker = faker();
    $domainName = 'newly-purchased-' . $faker->domainWord() . '.com';
    $itemId = 'hostingercom-domain-com-usd-1y';
    $paymentMethodId = $faker->randomNumber(6);
    $whoisId = $faker->randomNumber(6);

    $purchaseData = [
        'domain' => $domainName,
        'item_id' => $itemId,
        'payment_method_id' => $paymentMethodId,
        'domain_contacts' => [
            'owner_id' => $whoisId,
            'admin_id' => $whoisId,
            'billing_id' => $whoisId,
            'tech_id' => $whoisId,
        ],
        'coupons' => ['NEWDOMAIN10'],
    ];

    $orderResponse = TestFactory::order();

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/domains/v1/portfolio', $purchaseData)
        ->once()
        ->andReturn($orderResponse);

    $resource = new Portfolio($client);
    $response = $resource->purchase($purchaseData);

    expect($response)->toBeInstanceOf(OrderData::class)
        ->and($response->id)->toBe($orderResponse['id'])
        ->and($response->status->value)->toBe($orderResponse['status']);
});

test('can enable domain lock', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('put')
        ->with('/api/domains/v1/portfolio/' . $domain . '/domain-lock')
        ->once()
        ->andReturn($successResponse);

    $resource = new Portfolio($client);
    $response = $resource->enableDomainLock($domain);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can disable domain lock', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/domains/v1/portfolio/' . $domain . '/domain-lock')
        ->once()
        ->andReturn($successResponse);

    $resource = new Portfolio($client);
    $response = $resource->disableDomainLock($domain);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can enable privacy protection', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('put')
        ->with('/api/domains/v1/portfolio/' . $domain . '/privacy-protection')
        ->once()
        ->andReturn($successResponse);

    $resource = new Portfolio($client);
    $response = $resource->enablePrivacyProtection($domain);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can disable privacy protection', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/domains/v1/portfolio/' . $domain . '/privacy-protection')
        ->once()
        ->andReturn($successResponse);

    $resource = new Portfolio($client);
    $response = $resource->disablePrivacyProtection($domain);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can update nameservers', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $data = [
        'ns1' => 'ns1.example.com',
        'ns2' => 'ns2.example.com',
        'ns3' => 'ns3.example.com',
        'ns4' => 'ns4.example.com',
    ];
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('put')
        ->with('/api/domains/v1/portfolio/' . $domain . '/nameservers', $data)
        ->once()
        ->andReturn($successResponse);

    $resource = new Portfolio($client);
    $response = $resource->updateNameservers($domain, $data);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});
