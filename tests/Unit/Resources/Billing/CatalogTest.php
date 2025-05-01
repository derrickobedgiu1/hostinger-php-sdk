<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\CatalogItem;
use DerrickOb\HostingerApi\Resources\Billing\Catalog;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list catalog items', function (): void {
    $catalogItems = [
        TestFactory::catalogItem(['id' => 'hostingercom-vps-kvm1', 'name' => 'KVM 1', 'category' => 'VPS']),
        TestFactory::catalogItem(['id' => 'hostingercom-vps-kvm2', 'name' => 'KVM 2', 'category' => 'VPS']),
        TestFactory::catalogItem(['id' => 'hostingercom-domain-com', 'name' => '.COM Domain', 'category' => 'DOMAIN']),
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/billing/v1/catalog', [])
        ->once()
        ->andReturn($catalogItems);

    $resource = new Catalog($client);

    /** @var array<CatalogItem> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(3)
        ->and($response[0])->toBeInstanceOf(CatalogItem::class)
        ->and($response[0]->id)->toBe('hostingercom-vps-kvm1')
        ->and($response[0]->name)->toBe('KVM 1')
        ->and($response[0]->category)->toBe('VPS')
        ->and($response[0]->prices)->toBeArray()
        ->and($response[1]->id)->toBe('hostingercom-vps-kvm2')
        ->and($response[1]->name)->toBe('KVM 2')
        ->and($response[1]->category)->toBe('VPS')
        ->and($response[2]->id)->toBe('hostingercom-domain-com')
        ->and($response[2]->name)->toBe('.COM Domain')
        ->and($response[2]->category)->toBe('DOMAIN');
});

test('can list catalog items filtered by category', function (): void {
    $vpsItems = [
        TestFactory::catalogItem(['id' => 'hostingercom-vps-kvm1', 'name' => 'KVM 1', 'category' => 'VPS']),
        TestFactory::catalogItem(['id' => 'hostingercom-vps-kvm2', 'name' => 'KVM 2', 'category' => 'VPS']),
    ];
    $query = ['category' => 'VPS'];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/billing/v1/catalog', $query)
        ->once()
        ->andReturn($vpsItems);

    $resource = new Catalog($client);

    /** @var array<CatalogItem> $response */
    $response = $resource->list($query);

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(2)
        ->and($response[0]->category)->toBe('VPS')
        ->and($response[1]->category)->toBe('VPS');
});

test('can list catalog items filtered by name wildcard', function (): void {
    $comItems = [
        TestFactory::catalogItem(['id' => 'hostingercom-domain-com', 'name' => '.COM Domain', 'category' => 'DOMAIN']),
    ];
    $query = ['name' => '.COM*'];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/billing/v1/catalog', $query)
        ->once()
        ->andReturn($comItems);

    $resource = new Catalog($client);

    /** @var array<CatalogItem> $response */
    $response = $resource->list($query);

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(1)
        ->and($response[0]->name)->toBe('.COM Domain');
});
