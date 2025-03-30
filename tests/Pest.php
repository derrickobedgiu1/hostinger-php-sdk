<?php

use DerrickOb\HostingerApi\ClientInterface;
use Faker\Factory;
use Faker\Generator;

expect()->extend('toBeOne', fn () => $this->toBe(1));

function createMockClient(): ClientInterface
{
    $client = \Mockery::mock(ClientInterface::class);

    $client->shouldReceive('getApiVersion')
        ->andReturn('v1');

    return $client;
}

function faker(): Generator
{
    static $faker;

    if (!$faker) {
        $faker = Factory::create();
    }

    return $faker;
}
