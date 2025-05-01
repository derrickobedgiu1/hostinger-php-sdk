<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Data;

use DerrickOb\HostingerApi\Data\Domain\Domain;
use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can create paginated response and access data', function (): void {
    $items = [
        TestFactory::domain(['id' => 1, 'domain' => 'domain1.com']),
        TestFactory::domain(['id' => 2, 'domain' => 'domain2.com']),
    ];
    $meta = [
        'current_page' => 1,
        'per_page' => 10,
        'total' => 2,
    ];
    $responseArray = ['data' => $items, 'meta' => $meta];

    $paginatedResponse = new PaginatedResponse($responseArray, Domain::class);

    expect($paginatedResponse->getData())->toBeArray()->toHaveCount(2)
        ->and($paginatedResponse->getData()[0])->toBeInstanceOf(Domain::class)
        ->and($paginatedResponse->getData()[0]->id)->toBe(1);
});

test('can access pagination metadata', function (): void {
    $items = [TestFactory::domain(['id' => 1])];
    $meta = [
        'current_page' => 2,
        'per_page' => 5,
        'total' => 11,
    ];
    $responseArray = ['data' => $items, 'meta' => $meta];

    $paginatedResponse = new PaginatedResponse($responseArray, Domain::class);

    expect($paginatedResponse->getMeta())->toBe($meta)
        ->and($paginatedResponse->getCurrentPage())->toBe(2)
        ->and($paginatedResponse->getPerPage())->toBe(5)
        ->and($paginatedResponse->getTotal())->toBe(11);
});

test('handles response without meta key', function (): void {
    $items = [
        TestFactory::domain(['id' => 1]),
        TestFactory::domain(['id' => 2]),
    ];
    $responseArray = ['data' => $items];

    $paginatedResponse = new PaginatedResponse($responseArray, Domain::class);

    $meta = [
        'current_page' => 1,
        'per_page' => 2,
        'total' => 2,
    ];

    expect($paginatedResponse->getMeta())->toBe($meta)
        ->and($paginatedResponse->getCurrentPage())->toBe(1)
        ->and($paginatedResponse->getPerPage())->toBe(2)
        ->and($paginatedResponse->getTotal())->toBe(2)
        ->and($paginatedResponse->getData())->toHaveCount(2);
});

test('can convert paginated response to array', function (): void {
    $items = [
        TestFactory::domain(['id' => 1, 'domain' => 'domain1.com']),
    ];
    $meta = [
        'current_page' => 1,
        'per_page' => 10,
        'total' => 1,
    ];
    $responseArray = ['data' => $items, 'meta' => $meta];

    $paginatedResponse = new PaginatedResponse($responseArray, Domain::class);
    $arrayResult = $paginatedResponse->toArray();

    expect($arrayResult)->toBeArray()
        ->and($arrayResult['meta'])->toBe($meta)
        ->and($arrayResult['data'])->toBeArray()->toHaveCount(1)
        ->and($arrayResult['data'][0]['id'])->toBe(1)
        ->and($arrayResult['data'][0]['domain'])->toBe('domain1.com');
});

test('can serialize paginated response to json', function (): void {
    $items = [
        TestFactory::domain(['id' => 1, 'domain' => 'domain1.com']),
    ];
    $meta = [
        'current_page' => 1,
        'per_page' => 10,
        'total' => 1,
    ];
    $responseArray = ['data' => $items, 'meta' => $meta];

    $paginatedResponse = new PaginatedResponse($responseArray, Domain::class);
    $jsonResult = json_encode($paginatedResponse);
    $decodedResult = json_decode((string) $jsonResult, true);

    expect($decodedResult)->toBeArray()
        ->and($decodedResult['meta'])->toBe($meta)
        ->and($decodedResult['data'])->toBeArray()->toHaveCount(1)
        ->and($decodedResult['data'][0]['id'])->toBe(1)
        ->and($decodedResult['data'][0]['domain'])->toBe('domain1.com');
});
