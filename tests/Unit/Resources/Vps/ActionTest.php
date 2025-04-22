<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Enums\ActionState;
use DerrickOb\HostingerApi\Resources\Vps\Action;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list actions for a virtual machine', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $actions = [];
    for ($i = 0; $i < 3; $i++) {
        $actions[] = TestFactory::action();
    }

    $expectedResponse = [
        'data' => $actions,
        'meta' => [
            'current_page' => 1,
            'per_page' => 15,
            'total' => 3,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/actions', [])
        ->once()
        ->andReturn($expectedResponse);

    $resource = new Action($client);

    $response = $resource->list($virtualMachineId);

    expect($response)->toBeInstanceOf(PaginatedResponse::class)
        ->and($response->getData())->toBeArray()
        ->and($response->getData())->toHaveCount(3)
        ->and($response->getData()[0])->toBeInstanceOf(ActionData::class)
        ->and($response->getData()[0]->id)->toBe($actions[0]['id'])
        ->and($response->getData()[0]->name)->toBe($actions[0]['name'])
        ->and($response->getData()[0]->state)->toBeInstanceOf(ActionState::class);
});

test('can list actions with pagination', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);
    $page = 2;

    $actions = [];
    for ($i = 0; $i < 3; $i++) {
        $actions[] = TestFactory::action();
    }

    $expectedResponse = [
        'data' => $actions,
        'meta' => [
            'current_page' => $page,
            'per_page' => 15,
            'total' => 30,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/actions', ['page' => $page])
        ->once()
        ->andReturn($expectedResponse);

    $resource = new Action($client);

    $response = $resource->list($virtualMachineId, ['page' => (string)$page]);

    expect($response)->toBeInstanceOf(PaginatedResponse::class)
        ->and($response->getCurrentPage())->toBe($page)
        ->and($response->getData())->toHaveCount(3);
});

test('can get action details', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);
    $actionId = $faker->randomNumber(7);

    $actionData = TestFactory::action(['id' => $actionId, 'state' => ActionState::SUCCESS->value]);

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/actions/' . $actionId)
        ->once()
        ->andReturn($actionData);

    $resource = new Action($client);
    $response = $resource->get($virtualMachineId, $actionId);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($actionId)
        ->and($response->name)->toBe($actionData['name'])
        ->and($response->state)->toBe(ActionState::SUCCESS);
});
