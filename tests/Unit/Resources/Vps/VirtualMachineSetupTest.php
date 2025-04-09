<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Data\Vps\VirtualMachine as VirtualMachineData;
use DerrickOb\HostingerApi\Resources\Vps\VirtualMachine;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can setup new virtual machine', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $data = [
        'template_id' => $faker->randomNumber(7),
        'data_center_id' => $faker->randomNumber(2),
        'password' => $faker->password(12, 20),
        'hostname' => $faker->domainName(),
        'install_monarx' => false,
        'enable_backups' => true,
        'ns1' => '8.8.8.8',
        'ns2' => '8.8.4.4',
        'public_key' => [
            'name' => 'My Key',
            'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD' . $faker->sha256(),
        ],
    ];

    $virtualMachine = TestFactory::virtualMachine([
        'id' => $virtualMachineId,
        'hostname' => $data['hostname'],
    ]);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/setup', $data)
        ->once()
        ->andReturn($virtualMachine);

    $resource = new VirtualMachine($client);
    $response = $resource->setup($virtualMachineId, $data);

    expect($response)->toBeInstanceOf(VirtualMachineData::class)
        ->and($response->id)->toBe($virtualMachineId)
        ->and($response->hostname)->toBe($data['hostname']);
});

test('can recreate virtual machine', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $data = [
        'password' => $faker->password(12, 20),
        'template_id' => $faker->randomNumber(7),
    ];

    $action = TestFactory::action(['name' => 'recreate']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/recreate', $data)
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->recreate($virtualMachineId, $data);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->name)->toBe('recreate');
});

test('can set nameservers for virtual machine', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $data = [
        'ns1' => '8.8.8.8',
        'ns2' => '8.8.4.4',
    ];

    $action = TestFactory::action(['name' => 'set_nameservers']);

    $client = createMockClient();
    $client->shouldReceive('put')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/nameservers', $data)
        ->once()
        ->andReturn($action);

    $resource = new VirtualMachine($client);
    $response = $resource->setNameServers($virtualMachineId, $data);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->name)->toBe('set_nameservers');
});
