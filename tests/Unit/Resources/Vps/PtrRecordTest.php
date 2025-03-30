<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Resources\Vps\PtrRecord;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can create PTR record', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $action = TestFactory::action(['name' => 'create_ptr_record']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/ptr')
        ->once()
        ->andReturn($action);

    $resource = new PtrRecord($client);
    $response = $resource->create($virtualMachineId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('create_ptr_record');
});

test('can delete PTR record', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $action = TestFactory::action(['name' => 'delete_ptr_record']);

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/ptr')
        ->once()
        ->andReturn($action);

    $resource = new PtrRecord($client);
    $response = $resource->delete($virtualMachineId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('delete_ptr_record');
});
