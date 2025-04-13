<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Data\Vps\Metrics;
use DerrickOb\HostingerApi\Data\Vps\VirtualMachine as VirtualMachineData;
use DerrickOb\HostingerApi\Enums\ActionsLock;
use DerrickOb\HostingerApi\Enums\VirtualMachineState;
use DerrickOb\HostingerApi\Resources\Vps\VirtualMachine;
use DerrickOb\HostingerApi\Tests\TestFactory;
use Faker\Generator;

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

test('can get virtual machine metrics', function (): void {
    /** @var Generator $faker */
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $dateFrom = $faker->dateTimeBetween('-7 days', '-2 days')->format('Y-m-d\TH:i:s\Z');
    $dateTo = $faker->dateTimeBetween('-1 day', 'now')->format('Y-m-d\TH:i:s\Z');

    $query = [
        'date_from' => $dateFrom,
        'date_to' => $dateTo,
    ];

    $timestamps = [];
    $startTime = strtotime($dateFrom);
    $endTime = strtotime($dateTo);
    $interval = 600;
    $current = $startTime;

    while ($current <= $endTime) {
        $timestamps[] = (string) $current;
        $current += $interval;
    }

    $metricsResponse = [
        'cpu_usage' => [
            'unit' => '%',
            'usage' => array_combine(
                $timestamps,
                array_map(fn (): float => $faker->randomFloat(2, 0, 100), $timestamps)
            ),
        ],
        'ram_usage' => [
            'unit' => 'bytes',
            'usage' => array_combine(
                $timestamps,
                array_map(fn (): int => $faker->numberBetween(100000000, 2000000000), $timestamps)
            ),
        ],
        'disk_space' => [
            'unit' => 'bytes',
            'usage' => array_combine(
                $timestamps,
                array_map(fn (): int => $faker->numberBetween(1000000000, 5000000000), $timestamps)
            ),
        ],
        'outgoing_traffic' => [
            'unit' => 'bytes',
            'usage' => array_combine(
                $timestamps,
                array_map(fn (): int => $faker->numberBetween(10000, 1000000), $timestamps)
            ),
        ],
        'incoming_traffic' => [
            'unit' => 'bytes',
            'usage' => array_combine(
                $timestamps,
                array_map(fn (): int => $faker->numberBetween(10000, 1000000), $timestamps)
            ),
        ],
        'uptime' => [
            'unit' => 'milliseconds',
            'usage' => array_combine(
                $timestamps,
                array_map(fn (): int => $faker->numberBetween(1000, 9000000), $timestamps)
            ),
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/metrics', $query)
        ->once()
        ->andReturn($metricsResponse);

    $resource = new VirtualMachine($client);
    $response = $resource->getMetrics($virtualMachineId, $dateFrom, $dateTo);

    expect($response)->toBeInstanceOf(Metrics::class)
        ->and($response->cpu_usage->unit ?? '')->toBe('%')
        ->and($response->ram_usage->unit ?? '')->toBe('bytes')
        ->and($response->disk_space->unit ?? '')->toBe('bytes')
        ->and($response->outgoing_traffic->unit ?? '')->toBe('bytes')
        ->and($response->incoming_traffic->unit ?? '')->toBe('bytes')
        ->and($response->uptime->unit ?? '')->toBe('milliseconds')
        ->and($response->cpu_usage->usage ?? '')->toBeArray()
        ->and(count($response->cpu_usage->usage ?? ''))->toBe(count($timestamps));
});

test('can get attached public keys', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(5);

    $publicKeys = [];
    for ($i = 0; $i < 2; $i++) {
        $publicKeys[] = [
            'id' => $faker->randomNumber(7),
            'name' => 'Key ' . $faker->word(),
            'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD' . $faker->sha256(),
        ];
    }

    $response = [
        'data' => $publicKeys,
        'meta' => [
            'current_page' => 1,
            'per_page' => 15,
            'total' => 2,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/public-keys', [])
        ->once()
        ->andReturn($response);

    $resource = new VirtualMachine($client);
    $result = $resource->getAttachedPublicKeys($virtualMachineId);

    expect($result)->toBeInstanceOf(PaginatedResponse::class)
        ->and($result->getCurrentPage())->toBe(1)
        ->and($result->getTotal())->toBe(2)
        ->and($result->getData())->toHaveCount(2)
        ->and($result->getData()[0]->id)->toBe($publicKeys[0]['id'])
        ->and($result->getData()[0]->name)->toBe($publicKeys[0]['name'])
        ->and($result->getData()[0]->key)->toBe($publicKeys[0]['key']);
});
