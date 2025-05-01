<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Facades;

use DerrickOb\HostingerApi\Facades\DomainFacade;
use DerrickOb\HostingerApi\Resources\Domain\Availability;
use DerrickOb\HostingerApi\Resources\Domain\Forwarding;
use DerrickOb\HostingerApi\Resources\Domain\Portfolio;
use DerrickOb\HostingerApi\Resources\Domain\Whois;

test('can access the portfolio resource', function (): void {
    $client = createMockClient();
    $facade = new DomainFacade($client);
    expect($facade->portfolio())->toBeInstanceOf(Portfolio::class);
});

test('can access the availability resource', function (): void {
    $client = createMockClient();
    $facade = new DomainFacade($client);
    expect($facade->availability())->toBeInstanceOf(Availability::class);
});

test('can access the forwarding resource', function (): void {
    $client = createMockClient();
    $facade = new DomainFacade($client);
    expect($facade->forwarding())->toBeInstanceOf(Forwarding::class);
});

test('can access the whois resource', function (): void {
    $client = createMockClient();
    $facade = new DomainFacade($client);
    expect($facade->whois())->toBeInstanceOf(Whois::class);
});
