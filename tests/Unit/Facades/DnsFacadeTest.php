<?php

use DerrickOb\HostingerApi\Facades\DnsFacade;
use DerrickOb\HostingerApi\Resources\Dns\Snapshot;
use DerrickOb\HostingerApi\Resources\Dns\Zone;

test('can access the snapshot resource', function (): void {
    $client = createMockClient();
    $facade = new DnsFacade($client);
    expect($facade->snapshots())->toBeInstanceOf(Snapshot::class);
});

test('can access the zone resource', function (): void {
    $client = createMockClient();
    $facade = new DnsFacade($client);
    expect($facade->zones())->toBeInstanceOf(Zone::class);
});
