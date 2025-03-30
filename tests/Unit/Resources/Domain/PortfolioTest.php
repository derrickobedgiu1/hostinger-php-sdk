<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\Domain;
use DerrickOb\HostingerApi\Enums\DomainStatus;
use DerrickOb\HostingerApi\Enums\DomainType;
use DerrickOb\HostingerApi\Resources\Domain\Portfolio;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list domains in portfolio', function (): void {
    $domains = [
        TestFactory::domain(['name' => 'example1.com', 'type' => DomainType::DOMAIN->value, 'status' => DomainStatus::ACTIVE->value]),
        TestFactory::domain(['name' => 'example2.com', 'type' => DomainType::DOMAIN->value, 'status' => DomainStatus::ACTIVE->value]),
        TestFactory::domain(['name' => null, 'type' => DomainType::FREE_DOMAIN->value, 'status' => DomainStatus::PENDING_SETUP->value]),
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
        ->and($response)->toHaveCount(3)
        ->and($response[0])->toBeInstanceOf(Domain::class)
        ->and($response[0]->name)->toBe('example1.com')
        ->and($response[0]->type)->toBe(DomainType::DOMAIN)
        ->and($response[0]->status)->toBe(DomainStatus::ACTIVE)
        ->and($response[1])->toBeInstanceOf(Domain::class)
        ->and($response[1]->name)->toBe('example2.com')
        ->and($response[2])->toBeInstanceOf(Domain::class)
        ->and($response[2]->name)->toBeNull()
        ->and($response[2]->type)->toBe(DomainType::FREE_DOMAIN)
        ->and($response[2]->status)->toBe(DomainStatus::PENDING_SETUP);
});
