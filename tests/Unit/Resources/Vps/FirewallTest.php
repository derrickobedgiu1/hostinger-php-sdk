<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Firewall as FirewallData;
use DerrickOb\HostingerApi\Data\Vps\FirewallRule;
use DerrickOb\HostingerApi\Enums\FirewallAction;
use DerrickOb\HostingerApi\Enums\Protocol;
use DerrickOb\HostingerApi\Enums\Source;
use DerrickOb\HostingerApi\Resources\Vps\Firewall;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list firewalls', function (): void {
    $firewall = TestFactory::firewall();

    $expectedResponse = [
        'data' => [$firewall],
        'meta' => [
            'current_page' => 1,
            'per_page' => 15,
            'total' => 1,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/firewall', [])
        ->once()
        ->andReturn($expectedResponse);

    $resource = new Firewall($client);
    $response = $resource->list();

    expect($response)->toBeInstanceOf(PaginatedResponse::class)
        ->and($response->getData())->toBeArray()
        ->and($response->getData()[0])->toBeInstanceOf(FirewallData::class)
        ->and($response->getData()[0]->id)->toBe($firewall['id'])
        ->and($response->getData()[0]->name)->toBe($firewall['name'])
        ->and($response->getData()[0]->rules)->toBeArray();
});

test('can get firewall details', function (): void {
    /** @var array<string, mixed> $firewall */
    $firewall = TestFactory::firewall();
    $firewallId = $firewall['id'];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/firewall/' . $firewallId)
        ->once()
        ->andReturn($firewall);

    $resource = new Firewall($client);
    $response = $resource->get($firewallId);

    expect($response)->toBeInstanceOf(FirewallData::class)
        ->and($response->id)->toBe($firewallId)
        ->and($response->name)->toBe($firewall['name'])
        ->and($response->rules)->toBeArray();

    foreach ($response->rules as $index => $rule) {
        expect($rule)->toBeInstanceOf(FirewallRule::class)
            ->and($rule->id)->toBe($firewall['rules'][$index]['id'])
            ->and($rule->protocol)->toBeInstanceOf(Protocol::class)
            ->and($rule->action)->toBeInstanceOf(FirewallAction::class)
            ->and($rule->source)->toBeInstanceOf(Source::class);
    }
});

test('can create a firewall', function (): void {
    $faker = faker();
    $firewallName = $faker->words(3, true) . ' Firewall';
    $firewall = TestFactory::firewall(['name' => $firewallName]);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/firewall', ['name' => $firewallName])
        ->once()
        ->andReturn($firewall);

    $resource = new Firewall($client);
    $response = $resource->create(['name' => $firewallName]);

    expect($response)->toBeInstanceOf(FirewallData::class)
        ->and($response->name)->toBe($firewallName);
});

test('can create a firewall rule', function (): void {
    $faker = faker();
    $firewallId = $faker->randomNumber(5);
    $firewallRule = TestFactory::firewallRule();

    $data = [
        'protocol' => $firewallRule['protocol'],
        'port' => $firewallRule['port'],
        'source' => $firewallRule['source'],
        'source_detail' => $firewallRule['source_detail'],
    ];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/firewall/' . $firewallId . '/rules', $data)
        ->once()
        ->andReturn($firewallRule);

    $resource = new Firewall($client);
    $response = $resource->createRule($firewallId, $data);

    expect($response)->toBeInstanceOf(FirewallRule::class)
        ->and($response->id)->toBe($firewallRule['id'])
        ->and($response->protocol)->toBeInstanceOf(Protocol::class)
        ->and($response->port)->toBe($firewallRule['port']);
});

test('can activate a firewall', function (): void {
    $faker = faker();
    $firewallId = $faker->randomNumber(5);
    $virtualMachineId = $faker->randomNumber(5);

    $action = TestFactory::action(['name' => 'activate_firewall']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/firewall/' . $firewallId . '/activate/' . $virtualMachineId)
        ->once()
        ->andReturn($action);

    $resource = new Firewall($client);
    $response = $resource->activate($firewallId, $virtualMachineId);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe($action['name']);
});

test('can deactivate a firewall', function (): void {
    $faker = faker();
    $firewallId = $faker->randomNumber(5);
    $virtualMachineId = $faker->randomNumber(5);

    $action = TestFactory::action(['name' => 'deactivate_firewall']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/firewall/' . $firewallId . '/deactivate/' . $virtualMachineId)
        ->once()
        ->andReturn($action);

    $resource = new Firewall($client);
    $response = $resource->deactivate($firewallId, $virtualMachineId);

    expect($response)->toBeInstanceOf(Action::class)
        ->and($response->id)->toBe($action['id'])
        ->and($response->name)->toBe($action['name'])
        ->and($response->state->value)->toBe($action['state']);
});

test('can delete a firewall', function (): void {
    $faker = faker();
    $firewallId = $faker->randomNumber(5);
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/vps/v1/firewall/' . $firewallId)
        ->once()
        ->andReturn($successResponse);

    $resource = new Firewall($client);
    $response = $resource->delete($firewallId);

    expect($response)->toBe($successResponse);
});
