<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Data;

use DerrickOb\HostingerApi\Data\Domain\Domain;
use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\ResponseFactory;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('create handles single item', function (): void {
    $data = TestFactory::domain(['id' => 1]);
    $result = ResponseFactory::create(Domain::class, $data);

    expect($result)->toBeInstanceOf(Domain::class)
        ->and($result->id)->toBe(1);
});

test('createCollection handles multiple items', function (): void {
    $data = [
        TestFactory::domain(['id' => 1]),
        TestFactory::domain(['id' => 2]),
    ];
    $result = ResponseFactory::createCollection(Domain::class, $data);

    expect($result)->toBeArray()->toHaveCount(2)
        ->and($result[0])->toBeInstanceOf(Domain::class)
        ->and($result[0]->id)->toBe(1);
});

test('createCollection handles empty array', function (): void {
    $result = ResponseFactory::createCollection(Domain::class, []);
    expect($result)->toBeArray()->toBeEmpty();
});

test('createPaginated handles paginated response', function (): void {
    $data = [
        'data' => [TestFactory::domain(['id' => 1])],
        'meta' => ['current_page' => 1, 'per_page' => 10, 'total' => 1],
    ];
    $result = ResponseFactory::createPaginated(Domain::class, $data);

    expect($result)->toBeInstanceOf(PaginatedResponse::class)
        ->and($result->getCurrentPage())->toBe(1)
        ->and($result->getData())->toHaveCount(1);
});

test('createResponse identifies single item', function (): void {
    $data = TestFactory::domain(['id' => 1]);

    /** @var Domain $result */
    $result = ResponseFactory::createResponse(Domain::class, $data);

    expect($result)->toBeInstanceOf(Domain::class)
        ->and($result->id)->toBe(1);
});

test('createResponse identifies collection', function (): void {
    $data = [
        TestFactory::domain(['id' => 1]),
        TestFactory::domain(['id' => 2]),
    ];

    /** @var array<Domain> $result */
    $result = ResponseFactory::createResponse(Domain::class, $data);

    expect($result)->toBeArray()->toHaveCount(2)
        ->and($result[0])->toBeInstanceOf(Domain::class);
});

test('createResponse identifies paginated response', function (): void {
    $data = [
        'data' => [TestFactory::domain(['id' => 1])],
        'meta' => ['current_page' => 1, 'per_page' => 10, 'total' => 1],
    ];
    $result = ResponseFactory::createResponse(Domain::class, $data);

    expect($result)->toBeInstanceOf(PaginatedResponse::class);
});

test('createResponse handles empty array', function (): void {
    $result = ResponseFactory::createResponse(Domain::class, []);
    expect($result)->toBeArray()->toBeEmpty();
});
