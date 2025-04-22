<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit;

use DerrickOb\HostingerApi\ClientInterface;
use DerrickOb\HostingerApi\Facades\BillingFacade;
use DerrickOb\HostingerApi\Facades\DnsFacade;
use DerrickOb\HostingerApi\Facades\DomainFacade;
use DerrickOb\HostingerApi\Facades\VpsFacade;
use DerrickOb\HostingerApi\Hostinger;

test('can create hostinger client', function (): void {
    $hostinger = new Hostinger('test-token');
    expect($hostinger)->toBeInstanceOf(Hostinger::class);
});

test('can access billing facade', function (): void {
    $hostinger = new Hostinger('test-token');
    expect($hostinger->billing())->toBeInstanceOf(BillingFacade::class);
});

test('can access domain facade', function (): void {
    $hostinger = new Hostinger('test-token');
    expect($hostinger->domains())->toBeInstanceOf(DomainFacade::class);
});

test('can access dns facade', function (): void {
    $hostinger = new Hostinger('test-token');
    expect($hostinger->dns())->toBeInstanceOf(DnsFacade::class);
});

test('can access vps facade', function (): void {
    $hostinger = new Hostinger('test-token');
    expect($hostinger->vps())->toBeInstanceOf(VpsFacade::class);
});

test('can get the client instance', function (): void {
    $hostinger = new Hostinger('test-token');
    expect($hostinger->getClient())->toBeInstanceOf(ClientInterface::class);
});
