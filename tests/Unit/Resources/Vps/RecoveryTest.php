<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Resources\Vps\Recovery;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can start recovery mode', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);
    $rootPassword = $faker->password(12, 20);

    $data = [
        'root_password' => $rootPassword,
    ];

    $action = TestFactory::action(['name' => 'start_recovery']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/recovery', $data)
        ->once()
        ->andReturn($action);

    $resource = new Recovery($client);
    $response = $resource->start($virtualMachineId, $data);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('start_recovery');
});

test('can stop recovery mode', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $action = TestFactory::action(['name' => 'stop_recovery']);

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/recovery')
        ->once()
        ->andReturn($action);

    $resource = new Recovery($client);
    $response = $resource->stop($virtualMachineId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('stop_recovery');
});
