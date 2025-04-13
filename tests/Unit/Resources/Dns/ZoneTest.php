<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Dns;

use DerrickOb\HostingerApi\Data\Dns\Name;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Resources\Dns\Zone;

test('can get DNS zone records', function (): void {
    $faker = faker();
    $domain = $faker->domainName();

    $records = [];
    $recordTypes = ['A', 'AAAA', 'CNAME', 'MX', 'TXT', 'NS'];

    for ($i = 0; $i < 4; $i++) {
        $records[] = [
            'name' => $i === 0 ? '@' : $faker->word(),
            'records' => [
                [
                    'content' => $faker->ipv4(),
                    'disabled' => false,
                ],
            ],
            'ttl' => 14400,
            'type' => $recordTypes[array_rand($recordTypes)],
        ];
    }

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/dns/v1/zones/' . $domain)
        ->once()
        ->andReturn($records);

    $resource = new Zone($client);

    /** @var array<Name> $response */
    $response = $resource->getRecords($domain);

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(4)
        ->and($response[0])->toBeInstanceOf(Name::class)
        ->and($response[0]->name)->toBe($records[0]['name'])
        ->and($response[0]->ttl)->toBe($records[0]['ttl'])
        ->and($response[0]->type)->toBe($records[0]['type'])
        ->and($response[0]->records)->toBeArray()
        ->and($response[0]->records[0]->content)->toBe($records[0]['records'][0]['content']);
});

test('can reset DNS zone', function (): void {
    $faker = faker();
    $domain = $faker->domainName();

    $data = [
        'sync' => true,
        'reset_email_records' => false,
        'whitelisted_record_types' => ['MX', 'TXT'],
    ];

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/dns/v1/zones/' . $domain . '/reset', $data)
        ->once()
        ->andReturn($successResponse);

    $resource = new Zone($client);
    $response = $resource->reset($domain, $data);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});

test('can reset DNS zone with default options', function (): void {
    $faker = faker();
    $domain = $faker->domainName();

    $successResponse = ['message' => 'Request accepted'];

    $client = createMockClient();
    $client->shouldReceive('post')
        ->with('/api/dns/v1/zones/' . $domain . '/reset', [])
        ->once()
        ->andReturn($successResponse);

    $resource = new Zone($client);
    $response = $resource->reset($domain);

    expect($response)->toBeInstanceOf(SuccessResponse::class)
        ->and($response->message)->toBe($successResponse['message']);
});
