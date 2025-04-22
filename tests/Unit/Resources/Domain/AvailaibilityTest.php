<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\Availability as AvailabilityData;
use DerrickOb\HostingerApi\Resources\Domain\Availability;

test('can check domain availability', function (): void {
    $faker = faker();
    $domainName = $faker->domainWord();
    $tlds = ['com', 'net', 'org'];

    $data = [
        'domain' => $domainName,
        'tlds' => $tlds,
        'with_alternatives' => false,
    ];

    $results = [
        [
            'domain' => $domainName . '.com',
            'is_available' => true,
            'is_alternative' => false,
            'restriction' => null,
        ],
        [
            'domain' => $domainName . '.net',
            'is_available' => false,
            'is_alternative' => false,
            'restriction' => null,
        ],
        [
            'domain' => $domainName . '.org',
            'is_available' => true,
            'is_alternative' => false,
            'restriction' => 'Requires specific organization type',
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/domains/v1/availability', $data)
        ->once()
        ->andReturn($results);

    $resource = new Availability($client);

    /** @var array<AvailabilityData> $response */
    $response = $resource->check($data);

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(3)
        ->and($response[0])->toBeInstanceOf(AvailabilityData::class)
        ->and($response[0]->domain)->toBe($domainName . '.com')
        ->and($response[0]->is_available)->toBeTrue()
        ->and($response[0]->is_alternative)->toBeFalse()
        ->and($response[0]->restriction)->toBeNull()
        ->and($response[1]->domain)->toBe($domainName . '.net')
        ->and($response[1]->is_available)->toBeFalse()
        ->and($response[2]->domain)->toBe($domainName . '.org')
        ->and($response[2]->is_available)->toBeTrue()
        ->and($response[2]->restriction)->toBe('Requires specific organization type');
});

test('can check domain availability with alternatives', function (): void {
    $faker = faker();
    $domainName = $faker->domainWord();
    $tlds = ['shop'];

    $data = [
        'domain' => $domainName,
        'tlds' => $tlds,
        'with_alternatives' => true,
    ];

    $results = [
        [
            'domain' => $domainName . '.shop',
            'is_available' => false,
            'is_alternative' => false,
            'restriction' => null,
        ],
        [
            'domain' => $domainName . '-store.com',
            'is_available' => true,
            'is_alternative' => true,
            'restriction' => null,
        ],
    ];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/domains/v1/availability', $data)
        ->once()
        ->andReturn($results);

    $resource = new Availability($client);

    /** @var array<AvailabilityData> $response */
    $response = $resource->check($data);

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(2)
        ->and($response[0]->is_available)->toBeFalse()
        ->and($response[1]->is_available)->toBeTrue()
        ->and($response[1]->is_alternative)->toBeTrue();
});
