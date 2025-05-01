<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Data\Domain;

use DerrickOb\HostingerApi\Data\Domain\WhoisProfileUsage;

test('can create from array using static method', function (): void {
    $data = ['domain1.com', 'domain2.org'];
    $usage = WhoisProfileUsage::fromArray($data);

    expect($usage)->toBeInstanceOf(WhoisProfileUsage::class)
        ->and($usage->domains)->toBe($data);
});

test('can create collection using static method', function (): void {
    $data = ['domain1.com', 'domain2.org', 'domain3.net'];
    $collection = WhoisProfileUsage::collection($data);

    expect($collection)->toBeArray()->toHaveCount(1)
        ->and($collection[0])->toBeInstanceOf(WhoisProfileUsage::class)
        ->and($collection[0]->domains)->toBe($data);
});

test('can serialize to json', function (): void {
    $data = ['domain1.com', 'domain2.org'];
    $usage = new WhoisProfileUsage($data);

    $json = json_encode($usage);
    $expectedJson = json_encode($data);

    expect($json)->toBe($expectedJson);

    $serialized = $usage->jsonSerialize();
    expect($serialized)->toBe($data);
});

test('toArray returns the correct array', function (): void {
    $data = ['domain1.com', 'domain2.org'];
    $usage = new WhoisProfileUsage($data);

    expect($usage->toArray())->toBe($data);
});
