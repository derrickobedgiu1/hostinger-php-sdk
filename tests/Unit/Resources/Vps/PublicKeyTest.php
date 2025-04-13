<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Data\Vps\PublicKey as PublicKeyData;
use DerrickOb\HostingerApi\Resources\Vps\PublicKey;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list public keys', function (): void {
    $faker = faker();

    $publicKey = [];
    for ($i = 0; $i < 3; $i++) {
        $publicKey[] = [
            'id' => $faker->randomNumber(7),
            'name' => 'Key ' . $faker->word(),
            'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD' . $faker->sha256(),
        ];
    }

    $expectedResponse = [
        'data' => $publicKey,
        'meta' => [
            'current_page' => 1,
            'per_page' => 15,
            'total' => 3,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/public-keys', [])
        ->once()
        ->andReturn($expectedResponse);

    $resource = new PublicKey($client);

    $response = $resource->list();

    expect($response)->toBeInstanceOf(PaginatedResponse::class)
        ->and($response->getData())->toBeArray()
        ->and($response->getData())->toHaveCount(3)
        ->and($response->getData()[0])->toBeInstanceOf(PublicKeyData::class)
        ->and($response->getData()[0]->id)->toBe($publicKey[0]['id'])
        ->and($response->getData()[0]->name)->toBe($publicKey[0]['name'])
        ->and($response->getData()[0]->key)->toBe($publicKey[0]['key']);
});

test('can create new public key', function (): void {
    $faker = faker();
    $keyName = 'Key ' . $faker->word();
    $keyContent = 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD' . $faker->sha256();

    $publicKey = [
        'id' => $faker->randomNumber(7),
        'name' => $keyName,
        'key' => $keyContent,
    ];

    $data = [
        'name' => $keyName,
        'key' => $keyContent,
    ];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/public-keys', $data)
        ->once()
        ->andReturn($publicKey);

    $resource = new PublicKey($client);
    $response = $resource->create($data);

    expect($response)->toBeInstanceOf(PublicKeyData::class)
        ->and($response->id)->toBe($publicKey['id'])
        ->and($response->name)->toBe($keyName)
        ->and($response->key)->toBe($keyContent);
});

test('can delete a public key', function (): void {
    $faker = faker();
    $keyId = $faker->randomNumber(7);

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/vps/v1/public-keys/' . $keyId)
        ->once()
        ->andReturn($successResponse);

    $resource = new PublicKey($client);
    $response = $resource->delete($keyId);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can attach public key to virtual machine', function (): void {
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);
    $keyIds = [$faker->randomNumber(7), $faker->randomNumber(7)];

    $ids = [
        'ids' => $keyIds,
    ];

    $actionData = TestFactory::action(['name' => 'attach_public_key']);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/vps/v1/public-keys/attach/' . $virtualMachineId, $ids)
        ->once()
        ->andReturn($actionData);

    $resource = new PublicKey($client);
    $response = $resource->attach($virtualMachineId, $ids);

    expect($response)->toBeInstanceOf(ActionData::class)
        ->and($response->id)->toBe($actionData['id'])
        ->and($response->name)->toBe('attach_public_key');
});
