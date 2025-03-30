<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\DataCenter as DataCenterData;
use DerrickOb\HostingerApi\Resources\Vps\DataCenter;

test('can list data centers', function (): void {
    $faker = faker();

    $dataCenters = [];
    $locations = ['us', 'uk', 'nl', 'lt', 'sg'];
    $cities = ['Phoenix', 'London', 'Amsterdam', 'Vilnius', 'Singapore'];
    $continents = ['North America', 'Europe', 'Europe', 'Europe', 'Asia'];

    for ($i = 0; $i < 5; $i++) {
        $dataCenters[] = [
            'id' => $faker->randomNumber(2),
            'name' => strtolower($cities[$i]),
            'location' => $locations[$i],
            'city' => $cities[$i],
            'continent' => $continents[$i],
        ];
    }

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/data-centers')
        ->once()
        ->andReturn($dataCenters);

    $resource = new DataCenter($client);

    /** @var array<DataCenterData> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(5)
        ->and($response[0])->toBeInstanceOf(DataCenterData::class)
        ->and($response[0]->id)->toBe($dataCenters[0]['id'])
        ->and($response[0]->name)->toBe($dataCenters[0]['name'])
        ->and($response[0]->location)->toBe($dataCenters[0]['location'])
        ->and($response[0]->city)->toBe($dataCenters[0]['city'])
        ->and($response[0]->continent)->toBe($dataCenters[0]['continent'])
        ->and($response[3]->city)->toBe('Vilnius');
});
