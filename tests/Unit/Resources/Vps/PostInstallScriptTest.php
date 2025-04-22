<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Data\Vps\PostInstallScript as PostInstallScriptData;
use DerrickOb\HostingerApi\Resources\Vps\PostInstallScript;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list post-install scripts', function (): void {
    $scripts = [];
    for ($i = 0; $i < 3; $i++) {
        $scripts[] = TestFactory::postInstallScript();
    }

    $expectedResponse = [
        'data' => $scripts,
        'meta' => [
            'current_page' => 1,
            'per_page' => 15,
            'total' => 3,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/post-install-scripts', [])
        ->once()
        ->andReturn($expectedResponse);

    $resource = new PostInstallScript($client);

    $response = $resource->list();

    expect($response)->toBeInstanceOf(PaginatedResponse::class)
        ->and($response->getData())->toBeArray()
        ->and($response->getData())->toHaveCount(3)
        ->and($response->getData()[0])->toBeInstanceOf(PostInstallScriptData::class)
        ->and($response->getData()[0]->id)->toBe($scripts[0]['id'])
        ->and($response->getData()[0]->name)->toBe($scripts[0]['name'])
        ->and($response->getData()[0]->content)->toBe($scripts[0]['content']);
});

test('can get post-install script details', function (): void {
    $scriptId = faker()->randomNumber(7);
    $script = TestFactory::postInstallScript(['id' => $scriptId]);

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/post-install-scripts/' . $scriptId)
        ->once()
        ->andReturn($script);

    $resource = new PostInstallScript($client);
    $response = $resource->get($scriptId);

    expect($response)->toBeInstanceOf(PostInstallScriptData::class)
        ->and($response->id)->toBe($scriptId)
        ->and($response->name)->toBe($script['name'])
        ->and($response->content)->toBe($script['content']);
});

test('can create post-install script', function (): void {
    $faker = faker();
    $scriptName = 'Script ' . $faker->word();
    $scriptContent = '#!/bin/bash' . PHP_EOL . $faker->sentence();

    $data = [
        'name' => $scriptName,
        'content' => $scriptContent,
    ];

    $script = TestFactory::postInstallScript([
        'name' => $scriptName,
        'content' => $scriptContent,
    ]);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/post-install-scripts', $data)
        ->once()
        ->andReturn($script);

    $resource = new PostInstallScript($client);
    $response = $resource->create($data);

    expect($response)->toBeInstanceOf(PostInstallScriptData::class)
        ->and($response->id)->toBe($script['id'])
        ->and($response->name)->toBe($scriptName)
        ->and($response->content)->toBe($scriptContent);
});

test('can update post-install script', function (): void {
    $faker = faker();
    $scriptId = $faker->randomNumber(7);
    $scriptName = 'Updated Script ' . $faker->word();
    $scriptContent = '#!/bin/bash' . PHP_EOL . $faker->sentence();

    $data = [
        'name' => $scriptName,
        'content' => $scriptContent,
    ];

    $script = TestFactory::postInstallScript([
        'id' => $scriptId,
        'name' => $scriptName,
        'content' => $scriptContent,
    ]);

    $client = createMockClient();
    $client->shouldReceive('put')
        ->with('/api/vps/v1/post-install-scripts/' . $scriptId, $data)
        ->once()
        ->andReturn($script);

    $resource = new PostInstallScript($client);
    $response = $resource->update($scriptId, $data);

    expect($response)->toBeInstanceOf(PostInstallScriptData::class)
        ->and($response->id)->toBe($scriptId)
        ->and($response->name)->toBe($scriptName)
        ->and($response->content)->toBe($scriptContent);
});

test('can delete post-install script', function (): void {
    $scriptId = faker()->randomNumber(7);
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/vps/v1/post-install-scripts/' . $scriptId)
        ->once()
        ->andReturn($successResponse);

    $resource = new PostInstallScript($client);
    $response = $resource->delete($scriptId);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});
