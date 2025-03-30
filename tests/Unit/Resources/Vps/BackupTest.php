<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Data\Vps\Backup as BackupData;
use DerrickOb\HostingerApi\Resources\Vps\Backup;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list backups for a virtual machine', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $backups = [];
    for ($i = 0; $i < 2; $i++) {
        $backups[] = [
            'id' => $faker->randomNumber(7),
            'location' => $faker->randomElement(['nl-srv-openvzbackups', 'us-srv-openvzbackups']),
            'created_at' => $faker->dateTimeThisYear()->format('Y-m-d\TH:i:s\Z'),
        ];
    }

    $expectedResponse = [
        'data' => $backups,
        'meta' => [
            'current_page' => 1,
            'per_page' => 15,
            'total' => 2,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/backups', [])
        ->once()
        ->andReturn($expectedResponse);

    $resource = new Backup($client);

    $response = $resource->list($virtualMachineId);

    expect($response)->toBeInstanceOf(PaginatedResponse::class)
        ->and($response->getData())->toBeArray()
        ->and($response->getData())->toHaveCount(2)
        ->and($response->getData()[0])->toBeInstanceOf(BackupData::class)
        ->and($response->getData()[0]->id)->toBe($backups[0]['id'])
        ->and($response->getData()[0]->location)->toBe($backups[0]['location']);
});

test('can delete a backup', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);
    $backupId = $faker->randomNumber(7);

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/backups/' . $backupId)
        ->once()
        ->andReturn($successResponse);

    $resource = new Backup($client);
    $response = $resource->delete($virtualMachineId, $backupId);

    expect($response)->toBe($successResponse);
});

test('can restore a backup', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);
    $backupId = $faker->randomNumber(7);

    $action = TestFactory::action(['name' => 'restore_backup']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/backups/' . $backupId . '/restore')
        ->once()
        ->andReturn($action);

    $resource = new Backup($client);
    $response = $resource->restore($virtualMachineId, $backupId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('restore_backup');
});
