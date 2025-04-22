<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\CatalogItem;
use DerrickOb\HostingerApi\Resources\Billing\Catalog;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list catalog items', function (): void {
    $catalogItems = [
        TestFactory::catalogItem(['id' => 'hostingercom-vps-kvm1', 'name' => 'KVM 1']),
        TestFactory::catalogItem(['id' => 'hostingercom-vps-kvm2', 'name' => 'KVM 2']),
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/billing/v1/catalog')
        ->once()
        ->andReturn($catalogItems);

    $resource = new Catalog($client);

    /** @var array<CatalogItem> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response[0])->toBeInstanceOf(CatalogItem::class)
        ->and($response[0]->id)->toBe('hostingercom-vps-kvm1')
        ->and($response[0]->name)->toBe('KVM 1')
        ->and($response[0]->category)->toBe('VPS')
        ->and($response[0]->prices)->toBeArray()
        ->and($response[1]->id)->toBe('hostingercom-vps-kvm2')
        ->and($response[1]->name)->toBe('KVM 2')
        ->and($response[1]->category)->toBe('VPS');
});
