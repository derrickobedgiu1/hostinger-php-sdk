<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\WhoisProfile;
use DerrickOb\HostingerApi\Data\Domain\WhoisProfileUsage;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Resources\Domain\Whois;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list WHOIS profiles', function (): void {
    $profiles = [
        TestFactory::whoisProfile(['tld' => 'com']),
        TestFactory::whoisProfile(['tld' => 'net']),
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/domains/v1/whois', [])
        ->once()
        ->andReturn($profiles);

    $resource = new Whois($client);

    /** @var array<WhoisProfile> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(2)
        ->and($response[0])->toBeInstanceOf(WhoisProfile::class)
        ->and($response[0]->id)->toBe($profiles[0]['id'])
        ->and($response[0]->tld)->toBe('com')
        ->and($response[1]->tld)->toBe('net');
});

test('can list WHOIS profiles filtered by TLD', function (): void {
    $profiles = [TestFactory::whoisProfile(['tld' => 'org'])];
    $query = ['tld' => 'org'];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/domains/v1/whois', $query)
        ->once()
        ->andReturn($profiles);

    $resource = new Whois($client);

    /** @var array<WhoisProfile> $response */
    $response = $resource->list($query);

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(1)
        ->and($response[0]->tld)->toBe('org');
});

test('can create WHOIS profile', function (): void {
    $faker = faker();
    $data = [
        'tld' => 'com',
        'entity_type' => 'individual',
        'country' => 'US',
        'whois_details' => [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => $faker->email(),
            'phone' => $faker->phoneNumber(),
            'address1' => $faker->streetAddress(),
            'city' => $faker->city(),
            'state' => $faker->stateAbbr(),
            'zip' => $faker->postcode(),
        ],
    ];

    $profileResponse = TestFactory::whoisProfile($data);

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/domains/v1/whois', $data)
        ->once()
        ->andReturn($profileResponse);

    $resource = new Whois($client);
    $response = $resource->create($data);

    expect($response)->toBeInstanceOf(WhoisProfile::class)
        ->and($response->id)->toBe($profileResponse['id'])
        ->and($response->tld)->toBe('com')
        ->and($response->entity_type)->toBe('individual')
        ->and($response->whois_details['email'])->toBe($data['whois_details']['email']);
});

test('can get WHOIS profile', function (): void {
    $whoisId = faker()->randomNumber(6);
    $profile = TestFactory::whoisProfile(['id' => $whoisId]);

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/domains/v1/whois/' . $whoisId)
        ->once()
        ->andReturn($profile);

    $resource = new Whois($client);
    $response = $resource->get($whoisId);

    expect($response)->toBeInstanceOf(WhoisProfile::class)
        ->and($response->id)->toBe($whoisId)
        ->and($response->tld)->toBe($profile['tld']);
});

test('can delete WHOIS profile', function (): void {
    $whoisId = faker()->randomNumber(6);
    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('delete')
        ->with('/api/domains/v1/whois/' . $whoisId)
        ->once()
        ->andReturn($successResponse);

    $resource = new Whois($client);
    $response = $resource->delete($whoisId);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can get WHOIS profile usage', function (): void {
    $whoisId = faker()->randomNumber(6);
    $usageData = [
        'domain1.com',
        'anotherdomain.net',
    ];

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/domains/v1/whois/' . $whoisId . '/usage')
        ->once()
        ->andReturn($usageData);

    $resource = new Whois($client);
    $response = $resource->getUsage($whoisId);

    expect($response)->toBeInstanceOf(WhoisProfileUsage::class)
        ->and($response->domains)->toBe($usageData)
        ->and($response->toArray())->toBe($usageData);
});
