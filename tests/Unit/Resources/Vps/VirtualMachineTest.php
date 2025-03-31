<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\VirtualMachine as VirtualMachineData;
use DerrickOb\HostingerApi\Enums\ActionsLock;
use DerrickOb\HostingerApi\Enums\VirtualMachineState;
use DerrickOb\HostingerApi\Resources\Vps\VirtualMachine;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list virtual machines', function (): void {
    $virtualMachines = [
        TestFactory::virtualMachine(),
        TestFactory::virtualMachine(),
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines')
        ->once()
        ->andReturn($virtualMachines);

    $resource = new VirtualMachine($client);

    /** @var array<VirtualMachineData> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response[0])->toBeInstanceOf(VirtualMachineData::class)
        ->and($response[0]->id)->toBe($virtualMachines[0]['id'])
        ->and($response[0]->hostname)->toBe($virtualMachines[0]['hostname'])
        ->and($response[0]->state)->toBeInstanceOf(VirtualMachineState::class)
        ->and($response[0]->actions_lock)->toBeInstanceOf(ActionsLock::class)
        ->and($response[1]->id)->toBe($virtualMachines[1]['id'])
        ->and($response[1]->hostname)->toBe($virtualMachines[1]['hostname']);
});

test('can get virtual machine', function (): void {
    $virtualMachine = TestFactory::virtualMachine();
    $virtualMachineId = $virtualMachine['id'];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId)
        ->once()
        ->andReturn($virtualMachine);

    $resource = new VirtualMachine($client);
    $response = $resource->get($virtualMachineId);

    expect($response)->toBeInstanceOf(VirtualMachineData::class)
        ->and($response->id)->toBe($virtualMachineId)
        ->and($response->hostname)->toBe($virtualMachine['hostname'])
        ->and($response->state)->toBeInstanceOf(VirtualMachineState::class)
        ->and($response->actions_lock)->toBeInstanceOf(ActionsLock::class);
});

test('can start virtual machine', function (): void {
    $virtualMachineId = faker()->randomNumber(5);
    $action = TestFactory::action(['name' => 'start']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with(sprintf('/api/vps/v1/virtual-machines/%d/start', $virtualMachineId))
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->start($virtualMachineId);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('start');
});

test('can stop virtual machine', function (): void {
    $virtualMachineId = faker()->randomNumber(5);
    $action = TestFactory::action(['name' => 'stop']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with(sprintf('/api/vps/v1/virtual-machines/%d/stop', $virtualMachineId))
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->stop($virtualMachineId);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('stop');
});

test('can restart virtual machine', function (): void {
    $virtualMachineId = faker()->randomNumber(5);
    $action = TestFactory::action(['name' => 'restart']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with(sprintf('/api/vps/v1/virtual-machines/%d/restart', $virtualMachineId))
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->restart($virtualMachineId);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe('restart');
});

test('can set hostname', function (): void {
    $virtualMachineId = faker()->randomNumber(5);
    $hostname = faker()->domainName();
    $action = TestFactory::action(['name' => 'set_hostname']);

    $client = createMockClient();
    $client->shouldReceive('put')
        ->with(
            sprintf('/api/vps/v1/virtual-machines/%d/hostname', $virtualMachineId),
            ['hostname' => $hostname]
        )
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->setHostName($virtualMachineId, $hostname);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id']);
});

test('can reset hostname', function (): void {
    $virtualMachineId = faker()->randomNumber(5);
    $action = TestFactory::action(['name' => 'reset_hostname']);

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with(sprintf('/api/vps/v1/virtual-machines/%d/hostname', $virtualMachineId))
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->resetHostName($virtualMachineId);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id']);
});

test('can set root password', function (): void {
    $virtualMachineId = faker()->randomNumber(5);
    $password = faker()->password(8, 16);
    $action = TestFactory::action(['name' => 'set_root_password']);

    $client = createMockClient();
    $client->shouldReceive('put')
        ->with(
            sprintf('/api/vps/v1/virtual-machines/%d/root-password', $virtualMachineId),
            ['password' => $password]
        )
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->setRootPassword($virtualMachineId, $password);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id']);
});
