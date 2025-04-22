<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Dns;

use DerrickOb\HostingerApi\Data\Dns\Name;
use DerrickOb\HostingerApi\Data\Dns\Snapshot as SnapshotData;
use DerrickOb\HostingerApi\Data\Dns\SnapshotWithContent;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Resources\Dns\Snapshot;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list DNS snapshots', function (): void {
    $faker = faker();
    $domain = $faker->domainName();

    $snapshots = [];
    for ($i = 0; $i < 3; $i++) {
        $snapshots[] = TestFactory::dnsSnapshot();
    }

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/dns/v1/snapshots/' . $domain)
        ->once()
        ->andReturn($snapshots);

    $resource = new Snapshot($client);

    /** @var array<SnapshotData> $response */
    $response = $resource->list($domain);

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(3)
        ->and($response[0])->toBeInstanceOf(SnapshotData::class)
        ->and($response[0]->id)->toBe($snapshots[0]['id'])
        ->and($response[0]->reason)->toBe($snapshots[0]['reason']);
});

test('can get specific DNS snapshot with content', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $snapshotId = $faker->randomNumber(7);

    $snapshot = TestFactory::dnsSnapshotWithContent(['id' => $snapshotId]);

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/dns/v1/snapshots/' . $domain . '/' . $snapshotId)
        ->once()
        ->andReturn($snapshot);

    $resource = new Snapshot($client);
    $response = $resource->get($domain, $snapshotId);

    expect($response)->toBeInstanceOf(SnapshotWithContent::class)
        ->and($response->id)->toBe($snapshotId)
        ->and($response->reason)->toBe($snapshot['reason'])
        ->and($response->snapshot)->toBeArray()
        ->and($response->snapshot[0])->toBeInstanceOf(Name::class)
        ->and($response->snapshot[0]->name)->toBe($snapshot['snapshot'][0]['name'])
        ->and($response->snapshot[0]->records[0]->is_disabled)->toBe($snapshot['snapshot'][0]['records'][0]['is_disabled']);
});

test('can restore DNS snapshot', function (): void {
    $faker = faker();
    $domain = $faker->domainName();
    $snapshotId = $faker->randomNumber(7);

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/dns/v1/snapshots/' . $domain . '/' . $snapshotId . '/restore')
        ->once()
        ->andReturn($successResponse);

    $resource = new Snapshot($client);
    $response = $resource->restore($domain, $snapshotId);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});
