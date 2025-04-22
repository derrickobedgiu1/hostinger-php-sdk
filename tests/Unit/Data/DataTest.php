<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Data;

test('can create a DTO from array', function (): void {
    $data = ['id' => 1, 'name' => 'Test'];
    $dto = TestDataDto::fromArray($data);
    expect($dto)->toBeInstanceOf(TestDataDto::class)
        ->and($dto->id)->toBe(1)
        ->and($dto->name)->toBe('Test');
});

test('can create a DTO collection', function (): void {
    $items = [
        ['id' => 1, 'name' => 'Test 1'],
        ['id' => 2, 'name' => 'Test 2'],
    ];
    $collection = TestDataDto::collection($items);

    expect($collection)->toBeArray()
        ->and($collection)->toHaveCount(2)
        ->and($collection[0])->toBeInstanceOf(TestDataDto::class)
        ->and($collection[0]->id)->toBe(1)
        ->and($collection[1])->toBeInstanceOf(TestDataDto::class)
        ->and($collection[1]->id)->toBe(2);
});

test('can convert to array', function (): void {
    $data = ['id' => 1, 'name' => 'Test'];
    $dto = new TestDataDto($data);
    $result = $dto->toArray();
    expect($result)->toBeArray()
        ->and($result)->toHaveKey('id', 1)
        ->and($result)->toHaveKey('name', 'Test');
});

test('can serialize to json', function (): void {
    $data = ['id' => 1, 'name' => 'Test'];
    $dto = new TestDataDto($data);

    $result = $dto->jsonSerialize();
    expect($result)->toBeArray()
        ->and($result)->toHaveKey('id', 1)
        ->and($result)->toHaveKey('name', 'Test');

    $json = json_encode($dto);
    expect($json)->toBe('{"id":1,"name":"Test"}');
});
