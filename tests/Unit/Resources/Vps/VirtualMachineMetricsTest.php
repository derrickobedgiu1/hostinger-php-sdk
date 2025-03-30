<?php

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Metrics;
use DerrickOb\HostingerApi\Resources\Vps\VirtualMachine;
use Faker\Generator;

test('can get virtual machine metrics', function (): void {
    /** @var Generator $faker */
    $faker = faker();
    $virtualMachineId = $faker->randomNumber(7);

    $dateFrom = $faker->dateTimeBetween('-7 days', '-2 days')->format('Y-m-d\TH:i:s\Z');
    $dateTo = $faker->dateTimeBetween('-1 day', 'now')->format('Y-m-d\TH:i:s\Z');

    $data = [
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
        ->with('/api/vps/v1/virtual-machines/' . $virtualMachineId . '/metrics', $data)
        ->once()
        ->andReturn($metricsResponse);

    $resource = new VirtualMachine($client);
    $response = $resource->getMetrics($virtualMachineId, $data);

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
