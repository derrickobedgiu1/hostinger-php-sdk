<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Data\Vps\Snapshot as SnapshotData;
use DerrickOb\HostingerApi\Resources\Vps\Snapshot;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can get snapshot', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $createdAt = $faker->dateTimeThisMonth();
    $expiresAt = (clone $createdAt)->modify('+20 days');

    $snapshot = [
        'id' => $faker->randomNumber(7),
        'created_at' => $createdAt->format('Y-m-d\TH:i:s\Z'),
        'expires_at' => $expiresAt->format('Y-m-d\TH:i:s\Z'),
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/snapshot')
        ->once()
        ->andReturn($snapshot);

    $resource = new Snapshot($client);
    $response = $resource->get($virtualMachineId);

    expect($response)->toBeInstanceOf(SnapshotData::class)
        ->and($response->id)->toBe($snapshot['id']);
});

test('can create snapshot', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $action = TestFactory::action(['name' => 'create_snapshot']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/snapshot')
        ->once()
        ->andReturn($action);

    $resource = new Snapshot($client);
    $response = $resource->create($virtualMachineId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('create_snapshot');
});

test('can delete snapshot', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $action = TestFactory::action(['name' => 'delete_snapshot']);

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/snapshot')
        ->once()
        ->andReturn($action);

    $resource = new Snapshot($client);
    $response = $resource->delete($virtualMachineId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('delete_snapshot');
});

test('can restore snapshot', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $action = TestFactory::action(['name' => 'restore_snapshot']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/snapshot/restore')
        ->once()
        ->andReturn($action);

    $resource = new Snapshot($client);
    $response = $resource->restore($virtualMachineId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('restore_snapshot');
});
